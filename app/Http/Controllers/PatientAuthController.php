<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;
use App\Models\User;

class PatientAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.patient-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('pemail', $request->email)->first();

        if ($user && Hash::check($request->password, $user->ppassword)) {
            Auth::login($user);

            if ($user->usertype === 'patient') {
                return redirect()->route('patient.index');
            } elseif ($user->usertype === 'doctor') {
                return redirect()->route('doctor.index');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'pname' => 'required|string|max:255',
            'pemail' => 'required|email|unique:patient,pemail',
            'ppassword' => 'required|string|min:6|confirmed',
            'paddress' => 'required|string',
            'pdob' => 'required|date',
            'ptel' => 'required|string',
            'usertype' => 'required|in:patient,doctor', // Validasi untuk usertype
        ]);

        \Log::info('Signup request data:', $request->all());

        $patient = Patient::create([
            'pname' => $request->pname,
            'pemail' => $request->pemail,
            'ppassword' => Hash::make($request->ppassword),
            'paddress' => $request->paddress,
            'pdob' => $request->pdob,
            'ptel' => $request->ptel,
            'usertype' => $request->usertype, // Simpan usertype
        ]);

    \Log::info('Created patient:', $patient->toArray());

        Auth::login($patient);

        return redirect('/');
    }
}