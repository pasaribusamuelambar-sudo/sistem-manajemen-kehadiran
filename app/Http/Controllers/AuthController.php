<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auths.register'); 
    }

    // Mengunci pendaftaran agar email yang sama tidak bisa mendaftar dua kali
    public function processRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Kunci duplikasi
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin_super,admin_eksekutif,admin_operasional,karyawan' // PERBAIKAN: Mendukung 4 Level Akses
        ]);

        User::create([
            'id_kerja' => 'EMP-' . rand(1000, 9999), // Otomatis membuat ID Kerja unik saat registrasi awal
            'name' => $request->name,
            'email' => $request->email,
            'divisi' => 'Staff', // Default divisi awal karyawan baru
            'no_hp' => '08' . rand(1000000000, 9999999999), // Generate nomor hp sementara
            'password' => Hash::make($request->password),
            'real_password' => $request->password, // Menyimpan teks password asli untuk pantauan admin
            'role' => $request->role,
            'status' => 'Aktif', // Menyetel status default menjadi Aktif
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    public function showLogin() {
        return view('auths.login'); 
    }

    // Autentikasi dan pengalihan ke halaman admin/karyawan secara dinamis
    public function login(Request $request) {
        // 1. PERBAIKAN: Validasi role diubah agar menerima teks 'admin' atau 'karyawan' dari pilihan dropdown form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'string'] 
        ]);

        $selectedRole = $request->input('role');
        unset($credentials['role']); // Keluarkan role dari kredensial pengecekan password bawaan Laravel

        // 2. Lakukan percobaan login
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            // 3. PERBAIKAN UTAMA: Validasi kecocokan role secara fleksibel (menggunakan str_contains)
            // Jika user memilih 'admin' di form, dan role database mengandung kata 'admin' (seperti admin_super), maka lolos!
            if ($selectedRole === 'admin' && !str_contains($user->role, 'admin')) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akses ditolak. Akun Anda tidak terdaftar sebagai Admin.',
                ])->withInput($request->only('email'));
            }

            // Jika user memilih 'karyawan' di form, tapi di database rolenya bukan karyawan
            if ($selectedRole === 'karyawan' && $user->role !== 'karyawan') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akses ditolak. Akun Anda tidak terdaftar sebagai Karyawan.',
                ])->withInput($request->only('email'));
            }

            $request->session()->regenerate();

            // 4. Pengalihan rute secara otomatis berdasarkan hak akses database nyata
            if (str_contains($user->role, 'admin')) {
                return redirect()->route('home_admin')->with('success', 'Selamat datang kembali Admin, ' . $user->name);
            }
            
            return redirect()->route('home_karyawan')->with('success', 'Selamat datang, ' . $user->name);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput($request->only('email'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Berhasil keluar sistem.'); 
    }
}