<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes - PresensiHub
|--------------------------------------------------------------------------
*/

// 1. HALAMAN LANDING (Welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// 2. FITUR LOGIN
// Menampilkan Halaman Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Memproses Data Login
Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    
    // Logika sederhana: Jika email mengandung kata 'admin', masuk ke Home Admin
    if (str_contains($email, 'admin')) {
        return redirect()->route('home1'); 
    } else {
        return redirect()->route('home1');
    }
})->name('login.post');


// 3. FITUR REGISTER
// Menampilkan Halaman Register
Route::get('/register', function () {
    return view('register');
})->name('register');

// Memproses Data Register
Route::post('/register', function (Request $request) {
    $role = $request->input('role');
    
    if ($role == 'admin') {
        return redirect()->route('home1');
    } else {
        return redirect()->route('home');
    }
})->name('register.post');


// 4. HALAMAN DASHBOARD / HOME
// Home Khusus Admin (Memanggil file home1.blade.php)
Route::get('/home-admin', function () {
    return view('home1');
})->name('home1');

// Home Khusus Karyawan
Route::get('/home1', function () {
    // Pastikan kamu punya file home.blade.php atau ganti teks ini
    return "Selamat Datang di Halaman Karyawan"; 
})->name('home1');