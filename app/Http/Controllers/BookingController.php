<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;

class BookingController extends Controller
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

        return redirect()->route('booking.success', ['id' => $appointment->id])
                         ->with('status', 'Booking berhasil ditambahkan!');
    }
}
