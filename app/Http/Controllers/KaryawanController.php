<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    /**
     * Mengatur Navigasi Halaman Fitur Karyawan secara Dinamis
     */
    public function index(Request $request)
    {
        // Ambil entitas user yang sedang aktif terikat dengan session login
        $user = Auth::user();
        
        // Membaca parameter ?page= dari URL link sidebar
        $page = $request->query('page', 'dashboard');

        // Kembalikan ke satu induk master layout view saja
        return view('auths.home_karyawan', compact('page', 'user'));
    }
}