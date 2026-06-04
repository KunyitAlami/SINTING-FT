<?php

namespace App\Http\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = UserModel::where('NIM', $request->nim)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', 'NIM atau password salah.')
                ->withInput();
        }

        $request->session()->regenerate();

        session([
            'user_id' => $user->NIM,
            'nama' => $user->nama,
            'nim' => $user->NIM,
            'role' => $user->role,
        ]);

        if ($user->role === 'admin_kpu') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }

        return redirect()->route('login')->with('error', 'Role tidak dikenali.');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
