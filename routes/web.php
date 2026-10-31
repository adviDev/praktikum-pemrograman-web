<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;

Route::middleware("guest")->group(function () {
    Route::get("/login", [LoginController::class, "showLoginForm"])->name("login");
    Route::post("/login", [LoginController::class, "authenticate"])->name("login.attempt");
});

Route::middleware("auth")->group(function () {
    Route::get("/pengguna", [PenggunaController::class, 'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');

    Route::get('/', fn() => redirect()->route('dashboard'));

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/{nim}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
});
