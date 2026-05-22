<?php

namespace App\Http\Mahasiswa;

use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        if (!session('user_id') || session('role') !== 'mahasiswa') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai mahasiswa.');
        }

        return view('dashboard.dashboard_mahasiswa');
    }
}