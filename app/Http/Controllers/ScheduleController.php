<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB; // Import DB facade untuk menggunakan query builder

class ScheduleController extends Controller
{
        public function booking($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('booking', compact('schedule'));
    }
    public function schedule(Request $request)
    {
        // // Mulai session jika belum dimulai
        // if (!$request->session()->has('user') || $request->session()->get('usertype') !== 'p') {
        //     return redirect()->route('login'); // Redirect ke halaman login jika tidak ada session user atau usertype bukan 'p'
        // }

        // Ambil email dari session
        $useremail = $request->session()->get('user');

        // Query untuk mengambil data patient berdasarkan email
        $userfetch = DB::table('patient')
                        ->where('pemail', $useremail)
                        ->first(); // Ambil hanya satu baris pertama

        // Jika data tidak ditemukan, kembali ke halaman login
        if (!$userfetch) {
            return redirect()->route('login');
        }

        // Ambil data pid (patient id) dan pname (patient name) dari hasil query
        $userid = $userfetch->pid;
        $username = $userfetch->pname;

        // Set timezone Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        // Query untuk mengambil data schedule dan join dengan doctor berdasarkan tanggal yang lebih besar dari atau sama dengan $today
        $schedules = DB::table('schedule')
                        ->join('doctor', 'schedule.docid', '=', 'doctor.docid')
                        ->where('schedule.scheduledate', '>=', $today)
                        ->orderBy('schedule.scheduledate', 'asc')
                        ->get(); // Ambil semua data

        // Inisialisasi variabel pencarian dan jenis pencarian
        $insertkey = '';
        $searchtype = 'All';

        // Jika terdapat POST data dan field search tidak kosong
        if ($request->isMethod('post') && $request->filled('search')) {
            $keyword = $request->input('search');

            // Query untuk pencarian berdasarkan nama dokter, judul, atau tanggal
            $schedules = DB::table('schedule')
                            ->join('doctor', 'schedule.docid', '=', 'doctor.docid')
                            ->where('schedule.scheduledate', '>=', $today)
                            ->where(function ($query) use ($keyword) {
                                $query->where('doctor.docname', $keyword)
                                    ->orWhere('doctor.docname', 'like', $keyword . '%')
                                    ->orWhere('doctor.docname', 'like', '%' . $keyword)
                                    ->orWhere('doctor.docname', 'like', '%' . $keyword . '%')
                                    ->orWhere('schedule.title', $keyword)
                                    ->orWhere('schedule.title', 'like', $keyword . '%')
                                    ->orWhere('schedule.title', 'like', '%' . $keyword)
                                    ->orWhere('schedule.title', 'like', '%' . $keyword . '%')
                                    ->orWhere('schedule.scheduledate', $keyword)
                                    ->orWhere('schedule.scheduledate', 'like', $keyword . '%')
                                    ->orWhere('schedule.scheduledate', 'like', '%' . $keyword)
                                    ->orWhere('schedule.scheduledate', 'like', '%' . $keyword . '%');
                            })
                            ->orderBy('schedule.scheduledate', 'asc')
                            ->get(); // Ambil data hasil pencarian

            $insertkey = $keyword;
            $searchtype = 'Search Result : ';
        }

        // Return view 'patient.schedule' dengan mengirimkan data schedules, insertkey, dan searchtype
        return view('patient.schedule', [
            'schedules' => $schedules,
            'insertkey' => $insertkey,
            'searchtype' => $searchtype,
            'username' => $username,
            'useremail' => $useremail,
        ]);
        
    }

    public function index(Request $request)
    {
        $query = Schedule::with('doctor')->where('scheduledate', '>=', date('Y-m-d'));

        if ($request->has('search')) {
            $keyword = $request->input('search');
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('doctor', function ($q) use ($keyword) {
                    $q->where('docname', 'like', '%' . $keyword . '%');
                })
                ->orWhere('title', 'like', '%' . $keyword . '%')
                ->orWhere('scheduledate', 'like', '%' . $keyword . '%');
            });
        }

        $schedules = $query->orderBy('scheduledate', 'asc')->get();

        return view('patient.schedule', compact('schedules'));
    }

}
