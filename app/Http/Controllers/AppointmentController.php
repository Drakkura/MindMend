<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Schedule;

class AppointmentController extends Controller
{
    public function book(Request $request)
    {
        // Validasi input
        $request->validate([
            'apponum' => 'required|integer',
            'scheduleid' => 'required|integer',
            'date' => 'required|date',
        ]);

        // Ambil user berdasarkan email yang login
        $userEmail = $request->user()->email; // Misalkan Anda menggunakan auth untuk mendapatkan user
        $patient = Patient::where('pemail', $userEmail)->firstOrFail();
        
        // Buat appointment baru
        $appointment = Appointment::create([
            'pid' => $patient->pid,
            'apponum' => $request->input('apponum'),
            'scheduleid' => $request->input('scheduleid'),
            'appodate' => $request->input('date'),
        ]);

        return redirect()->route('appointment.success', ['id' => $appointment->id])
                         ->with('status', 'Booking berhasil ditambahkan!');
    }

    public function show(Request $request)
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
}