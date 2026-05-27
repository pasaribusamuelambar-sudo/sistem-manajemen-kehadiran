<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Storage;

// 1. LANDING PAGE
Route::get('/', function () {
    return view('auths.welcome');
})->name('welcome');

// 2. AUTHENTICATION
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', function (Request $request) {
    $role = $request->input('role');
    return ($role == 'admin') ? redirect()->route('home_admin') : redirect()->route('home_karyawan');
})->name('login.post');

Route::get('/register', function () {
    return view('auths.register');
})->name('register');

Route::post('/register', [AuthController::class, 'processRegister'])->name('register.post');

// 3. DASHBOARD ADMIN
Route::get('/admin/dashboard', [HomeController::class, 'home_admin'])->name('home_admin');

// 4. DASHBOARD KARYAWAN
Route::get('/karyawan/dashboard', function () {
    return view('auths.home_karyawan', ['page' => 'dashboard']);
})->name('home_karyawan');

// 5. FITUR LOGOUT
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('welcome'); 
})->name('logout');

// 6. FITUR IZIN
Route::post('/izin/proses', function (Request $request) {
    $request->validate([
        'jenis_izin' => 'required',
        'tgl_mulai'  => 'required|date',
        'tgl_selesai' => 'required|date',
        'alasan'      => 'required',
        'surat'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('surat')) {
        $file = $request->file('surat');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->storeAs('public/uploads/izin', $nama_file);
    }

    return redirect()->back()->with('success', 'Pengajuan izin berhasil dikirim!');
})->name('izin.auths');

// 7. PAGES (ABOUT & CONTACT)
Route::get('/about', function () {
    return view('auths.about');
})->name('about');

// Menggunakan nama rute 'contact' agar konsisten dengan pemanggilan route()
Route::get('/contact', function () {
    return view('auths.contact');
})->name('contact');

// KODE TAMBAHAN UNTUK PRAKTIKUM POIN 4 & 5
Route::get('/user/{id}', function ($id) {
    return 'User dengan ID ' . $id;
});