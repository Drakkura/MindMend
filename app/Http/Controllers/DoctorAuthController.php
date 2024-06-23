<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
class DoctorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.doctor-login');
    }

    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari dokter berdasarkan email
        $doctor = Doctor::where('docemail', $request->email)->first();

        if ($doctor) {
            // Debug log untuk mengecek password
            \Log::info('Stored Hash: ' . $doctor->docpassword);
            \Log::info('Input Password: ' . $request->password);

            if (Hash::check($request->password, $doctor->docpassword)) {
                Auth::guard('doctor')->login($doctor);
                return redirect()->intended('doctor/index');
            } else {
                \Log::error('Password does not match for email: ' . $request->email);
                return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
            }
        } else {
            \Log::error('Doctor not found with email: ' . $request->email);
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}