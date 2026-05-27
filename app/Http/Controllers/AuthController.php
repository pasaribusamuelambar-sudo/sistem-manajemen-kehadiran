<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Register
    public function showRegister() {
        return view('auths.register'); 
    }

    // Proses Simpan Data Register
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    // Menampilkan halaman Login
    public function showLogin() {
        return view('auths.login'); 
    }

    // Proses Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // BAGIAN DATABASE YANG ERROR SUDAH SAYA HAPUS TOTAL
            // Sekarang fokus ke redirect (Front-End)
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('home_admin');
            }
            
            return redirect()->route('home_karyawan');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil keluar sistem.'); 
    }
}