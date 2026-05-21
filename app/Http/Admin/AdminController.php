<?php

namespace App\Http\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!session('user_id') || session('role') !== 'admin_kpu') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai admin.');
        }

        $contractAddress = env('VOTING_CONTRACT_ADDRESS');

        $isContractConfigured = !empty($contractAddress);

        return view('dashboard.dashboard_admin', compact(
            'contractAddress',
            'isContractConfigured'
        ));
    }
}