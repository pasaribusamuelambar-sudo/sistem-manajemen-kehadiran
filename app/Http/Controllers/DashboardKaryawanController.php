<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalKerja;
use App\Models\Absensi;
use App\Models\Perizinan; // Ditambahkan untuk perizinan

class DashboardKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            $user = (object) [
                'id' => 3,
                'name' => 'Samuel Ambar Pasaribu',
                'role' => 'Staff',
                'divisi' => 'IT & Teknologi'
            ];
        }

        // PAKSA ZONA WAKTU ASIA/JAKARTA (WIB)
        $timezone = 'Asia/Jakarta';
        $hariIni = Carbon::now($timezone)->isoFormat('dddd'); 
        $tanggalIni = Carbon::today($timezone)->toDateString();

        $jadwalHariIni = null;
        if (class_exists('App\Models\JadwalKerja')) {
            try {
                $jadwalHariIni = JadwalKerja::where('hari', $hariIni)->first();
            } catch (\Exception $e) {}
        }

        if (!$jadwalHariIni) {
            $jadwalHariIni = (object) [
                'jam_masuk' => '08:00',
                'jam_pulang' => '17:00',
                'toleransi' => 15
            ];
        }

        $absensiHariIni = null;
        if (class_exists('App\Models\Absensi')) {
            try {
                $absensiHariIni = Absensi::where('user_id', $user->id)
                                         ->where('tanggal', $tanggalIni)
                                         ->first();
            } catch (\Exception $e) {}
        }

        $ringkasan = [
            'hadir'     => 0,
            'terlambat' => 0,
            'izin'      => 0,
            'alpha'     => 0,
        ];

        if (class_exists('App\Models\Absensi')) {
            try {
                $ringkasan['hadir'] = Absensi::where('user_id', $user->id)->where('status_masuk', 'Tepat Waktu')->count();
                $ringkasan['terlambat'] = Absensi::where('user_id', $user->id)->where('status_masuk', 'Terlambat')->count();
                $ringkasan['izin'] = Absensi::where('user_id', $user->id)->where('status_masuk', 'Izin')->count();
                $ringkasan['alpha'] = Absensi::where('user_id', $user->id)->where('status_masuk', 'Alpha')->count();
            } catch (\Exception $e) {}
        }

        $matrixAbsensi = [];
        if (class_exists('App\Models\Absensi')) {
            try {
                $matrixAbsensi = Absensi::where('user_id', $user->id)
                                        ->whereMonth('tanggal', Carbon::now($timezone)->month)
                                        ->pluck('status_masuk', 'tanggal')
                                        ->toArray();
            } catch (\Exception $e) {}
        }

        $riwayatPekanIni = collect([]);
        if (class_exists('App\Models\Absensi')) {
            try {
                $riwayatPekanIni = Absensi::where('user_id', $user->id)
                                           ->orderBy('tanggal', 'desc')
                                           ->take(7)
                                           ->get();
            } catch (\Exception $e) {}
        }

        // AMBIL DATA PERIZINAN KARYAWAN DARI DATABASE
        $izinData = collect([]);
        if (class_exists('App\Models\Perizinan')) {
            try {
                $izinData = Perizinan::where('user_id', $user->id)
                                     ->orWhere('nama', $user->name)
                                     ->orderBy('created_at', 'desc')
                                     ->get();
            } catch (\Exception $e) {}
        }

        return view('auths.karyawan_dashboard', compact(
            'user', 
            'jadwalHariIni', 
            'absensiHariIni', 
            'riwayatPekanIni', 
            'ringkasan', 
            'matrixAbsensi',
            'izinData' // Variabel $izinData berhasil dikirim ke Blade tanpa error!
        ));
    }
}