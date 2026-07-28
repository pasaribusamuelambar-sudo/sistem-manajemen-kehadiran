<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardKaryawanController; 
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KaryawanProfilController;
use App\Http\Controllers\IzinController; 
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawandivisiController;

// 1. LANDING PAGE
Route::get('/', function () { return view('auths.welcome'); })->name('welcome');
Route::get('/about', function () { return view('auths.about'); })->name('about');
Route::get('/contact', function () { return view('auths.contact'); })->name('contact');

// 2. AUTENTIKASI SISTEM (LOGIN & REGISTER)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.post');

// 3. DASHBOARD MANAGEMENT ADMIN (PROTECTED WITH AUTH)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Rute Utama & Monitoring Admin
    Route::get('/dashboard', [HomeController::class, 'home_admin'])->name('home_admin');
    Route::get('/monitoring', function() { return view('auths.monitoring', ['data' => collect([])]); })->name('admin.monitoring');
    
    // Kelola Surat Izin Admin (Mengakses Database via IzinController)
    Route::get('/kelola-izin', [IzinController::class, 'index'])->name('admin.kelola_izin');
    Route::patch('/kelola-izin/{id}/status', [IzinController::class, 'updateStatus'])->name('izin.update-status');
    
    // CRUD Karyawan
    Route::post('/karyawan/store', [KaryawandivisiController::class, 'store'])->name('admin.karyawan.store');
    Route::put('/karyawan/update/{id}', [KaryawandivisiController::class, 'update'])->name('admin.karyawan.update');
    Route::delete('/karyawan/delete/{id}', [KaryawandivisiController::class, 'destroy'])->name('admin.karyawan.delete');
});

// 4. DASHBOARD KARYAWAN SYSTEM (PROTECTED WITH AUTH)
Route::middleware(['auth'])->prefix('karyawan')->group(function () {
    Route::get('/dashboard', [DashboardKaryawanController::class, 'index'])->name('home_karyawan');
    Route::get('/monitoring', [DashboardKaryawanController::class, 'index'])->name('karyawan.monitoring');
    
    // Halaman Izin Karyawan
    Route::get('/izin', [IzinController::class, 'karyawanIndex'])->name('karyawan.izin'); 
    
    Route::get('/profil', [KaryawanProfilController::class, 'tampilkan'])->name('karyawan.profil');
    Route::post('/absen/proses', [KaryawanController::class, 'prosesAbsen'])->name('karyawan.absen.proses');
    Route::post('/absen/proses-auths', [KaryawanController::class, 'prosesAbsen'])->name('karyawan.absen.auths'); 
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    
    Route::post('/profil/update', [KaryawanProfilController::class, 'updateProfil'])->name('karyawan.profil.update');
    Route::post('/profil/sandi', [KaryawanProfilController::class, 'updateSandi'])->name('karyawan.profil.sandi');
});

// 5. BACKEND PROCESSORS (GLOBAL ACTIONS)
Route::post('/izin/proses', [IzinController::class, 'store'])->name('izin.store'); 
Route::post('/izin/proses-auths', [IzinController::class, 'store'])->name('izin.auths'); 
Route::post('/presensi/store', [AbsensiController::class, 'store'])->name('presensi.store');
Route::post('/lembur/proses', function (Request $request) {
    return redirect()->to('/karyawan/dashboard?page=lembur')->with('success', 'Pengajuan lembur berhasil dikirim!');
})->name('lembur.auths');