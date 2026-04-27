<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Kita import class Controller induknya
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    /**
     * Menampilkan halaman Dashboard Utama
     */
    public function index()
    {
        // Fungsi ini akan mencari file di resources/views/dashboard.blade.php
        return view('dashboard');
    }

    /**
     * (Opsional) Fungsi untuk proses absensi nanti
     */
    public function store(Request $request)
    {
        // Logic simpan absen akan di sini nanti
    }
}