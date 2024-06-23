<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Method untuk mengambil data umum yang diperlukan
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

    // Method untuk menampilkan halaman index patient
    public function index()
    {
        $user = Auth::user();
    $data = $this->getGeneralData();
    return view('patient.index', $data);
    }
    
    // Method untuk menampilkan halaman daftar dokter patient
    public function doctors(Request $request)
    {
        // Ambil data dokter
        $user = Auth::user();
        $doctors = Patient::where('usertype', 'doctor')->get();
        $list = Patient::where('usertype', 'doctor')->get();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $doctors = Patient::where('usertype', 'doctor')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $searchTerm . '%');
                })
                ->get();
                $hasSearchResults = $doctors->isNotEmpty();
        }else {
            $hasSearchResults = false;
        }

        return view('patient.doctors', compact('doctors','user','list','hasSearchResults'));
    }

    // Method untuk pencarian dokter
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

        return view('patient.doctors', compact('user', 'doctors', 'list', 'list11', 'specialties', 'hasSearchResults'));
    
    }

    // Method untuk menampilkan halaman sesi yang dijadwalkan patient
 // Method untuk menampilkan halaman sesi yang dijadwalkan patient
public function schedule(Request $request)
{
    $data = $this->getGeneralData();

    $searchTerm = $request->input('search');
    $schedules = Schedule::where('title', 'like', '%' . $searchTerm . '%')
        ->orWhere('scheduledate', 'like', '%' . $searchTerm . '%')
        ->orWhereHas('doctor', function ($query) use ($searchTerm) {
            $query->where('docname', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('scheduledate')
        ->orderBy('scheduletime')
        ->get();

    $data['schedules'] = $schedules;
    $doctors = Doctor::distinct()->select('docname')->get();
    $list11 = Schedule::all();
    $user = Auth::user();

    return view('patient.schedule', compact('user', 'doctors', 'schedules', 'list11'));
}

public function searchSchedule(Request $request)
{
    $data = $this->getGeneralData();

        $searchTerm = $request->input('search');
        $schedules = Schedule::where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('scheduledate', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('doctor', function ($query) use ($searchTerm) {
                $query->where('docname', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('scheduledate')
            ->orderBy('scheduletime')
            ->get();

        $data['schedules'] = $schedules;
        $doctors = Doctor::distinct()->select('docname')->get();
        $user = Auth::user();
        $searchschedule = "Your Search Results";

        return view('patient.schedule', compact('user', 'doctors', 'schedules', 'searchschedule'));
    }

    public function appointment(Request $request, $id = null)
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

        return view('patient.appointment', compact('appointments', 'schedules', 'user'));
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('patient.appointment')->with('success', 'Appointment canceled successfully.');
    }
    
    public function setting(Request $request)
    {
        $user = auth()->user();
        return view('patient.settings', compact('user'));
    }

    // Method untuk mengedit data user
    public function editUser(Request $request)
    {
        $request->validate([
            'pemail' => 'required|email',
            'pname' => 'required|string|max:255',
            'ptel' => 'required|string|max:20',
            'paddress' => 'required|string|max:255',
            'ppassword' => 'nullable|string|min:8|confirmed',
        ]);
    
        $user = Auth::user();
        $user->pemail = $request->pemail;
        $user->pname = $request->pname;
        $user->ptel = $request->ptel;
        $user->paddress = $request->paddress;
    
        if ($request->filled('ppassword')) {
            $user->ppassword = Hash::make($request->ppassword);
        }
    
        $user->save();
    
        return redirect()->route('patient.settings')->with('success', 'User details updated successfully!');
    }
    
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json('Failed to delete account. Incorrect password.', 400);
        }
    
        $user->delete();
    
        return response()->json('success');
    }
    public function book($id)
    {
        // Logika untuk menampilkan halaman pemesanan dengan detail sesi yang dipilih
        \Log::info('Booking ID: ' . $id);
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return redirect()->route('schedule')->with('error', 'Session not found.');
        }

        return view('booking', compact('schedule'));
    }
}
