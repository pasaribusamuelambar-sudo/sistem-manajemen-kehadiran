<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import model yang digunakan (pastikan model ini sudah ada di folder App\Models)
// Jika belum ada modelnya, statistik akan default ke angka manual
use App\Models\Karyawan; 
use App\Models\Presensi;

class HomeController extends Controller
{
    /**
     * Menangani halaman Dashboard Admin
     */
    public function home_admin(Request $request) 
    {
        // 1. Menangkap parameter 'page' dari URL (contoh: ?page=profile)
        // Jika kosong, default akan menampilkan 'dashboard'
        $page = $request->query('page', 'dashboard'); 

        // 2. Mengambil data statistik nyata dari Database
        // Jika tabel belum ada, kita gunakan '??' untuk memberikan angka default agar tidak error
        $stats = [
            'total_karyawan' => 156, // Ganti dengan Karyawan::count() jika database siap
            'hadir'          => 120, // Ganti dengan logika Presensi jika database siap
        ];

        // 3. Mengirim data ke view home1.blade.php
        return view('auths.home1', [
            'page' => $page,
            'stats' => $stats
        ]);
    }
}