<?php

use Illuminate\Support\Facades\Route;
use App\Http\Auth\LoginController;
use App\Http\Admin\AdminController;
use App\Http\Mahasiswa\MahasiswaController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])
    ->name('mahasiswa.dashboard');

Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])
    ->name('mahasiswa.dashboard');