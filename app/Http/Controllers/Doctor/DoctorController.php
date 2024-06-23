<?php
// app/Http/Controllers/Patient/DoctorController.php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class DoctorController extends Controller
{
    private function getGeneralData()
    {
        return [
            'user' => Auth::user(),
            //'doctorCount' => Doctor::count(),
            'patientCount' => Patient::count(),
            'appointmentCount' => Appointment::count(),
            'sessionCount' => Session::count(),
            'appointments' => Appointment::all(),
        ];
    }
    public function index()
    {
        $user = Auth::user();
        $totalDoctors = Doctor::count();
        $totalPatients = Patient::count();
        $newBookings = Appointment::whereDate('appodate', '>=', now())->count();
        $todaySessions = Schedule::whereDate('scheduledate', today())->count();
        $upcomingSessions = $this->getUpcomingSessions();
    
        $data = [
            'user' => $user,
            'totalDoctors' => $totalDoctors,
            'totalPatients' => $totalPatients,
            'newBookings' => $newBookings,
            'todaySessions' => $todaySessions,
            'upcomingSessions' => $upcomingSessions,
        ];

    return view('doctor.index', $data);
    }

    public function view($id)
    {
        // Ambil data dokter berdasarkan ID
        $doctor = Doctor::find($id);
        return view('doctor.doctor', compact('doctor'));
    }
    private function getUpcomingSessions()
    {
        // Mengambil sesi yang akan datang, misalnya dengan mengambil jadwal yang belum lewat
        $upcomingSessions = Schedule::whereDate('scheduledate', '>=', now())->get();
        return $upcomingSessions;
    }

    public function edit($id)
    {
        // Ambil data dokter berdasarkan ID untuk diedit
        $doctor = Doctor::find($id);
        return view('doctor.doctor', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan simpan data yang diperbarui
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tele' => 'required',
            'spec' => 'required',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password',
        ]);

        $doctor = Doctor::find($id);
        $doctor->docname = $request->name;
        $doctor->docemail = $request->email;
        $doctor->doctel = $request->tele;
        $doctor->specialties = $request->spec;
        $doctor->docpassword = bcrypt($request->password);
        $doctor->save();

        return redirect()->route('doctor.doctors')->with('success', 'Doctor updated successfully!');
    }

    public function delete($id)
    {
        // Hapus dokter berdasarkan ID
        $doctor = Doctor::find($id);
        $doctor->delete();

        return redirect()->route('doctor.doctors')->with('success', 'Doctor deleted successfully!');
    }
    public function showDoctors(Request $request)
{
    
    $user = Auth::user();
        $doctors = Doctor::orderBy('docid', 'desc')->get();
        $list = Doctor::select('docname', 'docemail')->get();
        $specialties = Specialty::all();
        $list11 = Doctor::all();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $doctors = Doctor::where('docname', 'like', '%' . $searchTerm . '%')
                ->orWhere('docemail', 'like', '%' . $searchTerm . '%')
                ->get();
            $hasSearchResults = $doctors->isNotEmpty();
        } else {
            $hasSearchResults = false;
        }

        return view('doctor.doctors', compact('user', 'doctors', 'list', 'list11', 'specialties', 'hasSearchResults'));
    
}
public function searchDoctor(Request $request)
    {
        $searchTerm = $request->input('search');
        $doctors = Doctor::where('docname', 'like', '%' . $searchTerm . '%')
            ->orWhere('docemail', 'like', '%' . $searchTerm . '%')
            ->get();

        $user = Auth::user();
        $list = Doctor::select('docname', 'docemail')->get();
        $specialties = Specialty::all();
        $list11 = Doctor::all();
        $hasSearchResults = $doctors->isNotEmpty();

        return view('doctor.doctors', compact('user', 'doctors', 'list', 'list11', 'specialties', 'hasSearchResults'));
    
    }

public function showSchedule()
{
    $user = Auth::user();
    $data = $this->getGeneralData();
    $schedules = Schedule::all();
    return view('doctor.schedule', compact('user','schedules'));
}

public function showAppointments(Request $request, $id = null)
{
    $user = auth()->user();
        $appointments = Appointment::where('pid', $user->id)->get();
        $schedules = Schedule::all();

        if ($request->has('scheduledate')) {
            $appointments = $appointments->where('appodate', $request->input('scheduledate'));
        }

        if ($request->has('action')) {
            $action = $request->input('action');
            $appointmentId = $request->input('id');
            $appointment = Appointment::find($appointmentId);

            if ($action === 'view' && $appointment) {
                $doctor = $appointment->schedule->doctor; // Assuming Schedule has relation with Doctor
                return view('patient.view_appointment', compact('appointment', 'doctor'));
            }

            if ($action === 'drop' && $appointment) {
                $appointment->delete();
                return redirect()->route('patient.appointment')->with('success', 'Appointment canceled successfully.');
            }
        }

        return view('doctor.appointment', compact('appointments', 'schedules', 'user'));
    }

public function showSettings()
{
    $user = auth()->user();
        return view('doctor.settings', compact('user'));
}
}
