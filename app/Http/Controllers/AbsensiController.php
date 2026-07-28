<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\JadwalKerja;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $userId = $user ? $user->id : 3;
        $namaUser = $user ? $user->name : 'SAMUEL AMBAR PASARIBU';
        $divisiUser = $user ? $user->divisi : 'IT & Teknologi';

        $action = $request->input('action'); 
        
        // PAKSA ZONA WAKTU ASIA/JAKARTA (WIB)
        $timezone = 'Asia/Jakarta';
        $tanggalIni = Carbon::today($timezone)->toDateString();
        $waktuSekarang = Carbon::now($timezone)->toTimeString();
        
        $hariIniId = Carbon::now($timezone)->isoFormat('dddd'); 
        $hariAngka = Carbon::now($timezone)->dayOfWeek; 

        // Ambil data tanggal dan jam realtime berformat Indonesia (WIB)
        $tanggalFormatMonitoring = Carbon::now($timezone)->isoFormat('DD MMMM YYYY');
        $jamFormatMonitoring = Carbon::now($timezone)->format('H:i');

        $jadwal = null;
        try {
            $jadwal = JadwalKerja::where('divisi', $divisiUser)
                ->where(function($query) use ($hariIniId) {
                    $query->where('hari', $hariIniId)
                          ->orWhere('hari', 'LIKE', '%' . $hariIniId . '%');
                })
                ->first();

            if (!$jadwal) {
                $jadwal = JadwalKerja::where('divisi', $divisiUser)->first();
            }
        } catch (\Exception $e) {}

        // SINKRONISASI DISINI: Fallback jadwal kerja diubah dari jam malam ke jam pagi agar sesuai dengan shift asli
        if (!$jadwal) {
            $jadwal = (object) [
                'jam_masuk' => '08:00:00', 
                'jam_pulang' => '15:00:00',
                'toleransi' => 15
            ];
        }

        $status = 'Hadir'; 

        if ($action === 'masuk') {
            $jamMasukJadwal = Carbon::parse($jadwal->jam_masuk);
            $batasToleransi = $jamMasukJadwal->copy()->addMinutes($jadwal->toleransi);
            $waktuPresensi = Carbon::parse($waktuSekarang);
            
            if (($hariAngka == 0 || $hariAngka == 6) && !str_contains(strtolower($jadwal->hari ?? ''), 'sabtu') && !str_contains(strtolower($jadwal->hari ?? ''), 'minggu')) {
                $status = 'Hadir'; 
            } else if ($waktuPresensi->gt($batasToleransi)) {
                // Status disimpan sebagai 'Terlambat' jika lewat batas toleransi (08:15 WIB)
                $status = 'Terlambat';
            } else {
                // Status disimpan sebagai 'Tepat Waktu' agar sinkron dengan query ringkasan
                $status = 'Tepat Waktu';
            }

            try {
                Absensi::updateOrCreate(
                    ['user_id' => $userId, 'tanggal' => $tanggalIni],
                    [
                        'jam_masuk' => $waktuSekarang,
                        'status_masuk' => $status,
                        'lokasi' => $request->input('latitude') . ',' . $request->input('longitude')
                    ]
                );
            } catch (\Exception $e) {}

            // Ubah display text status di session flash untuk user agar di halaman depan tetap tampil "Hadir" atau "Terlambat"
            $statusDisplay = ($status === 'Tepat Waktu') ? 'Hadir' : 'Terlambat';

            return redirect()->back()->with([
                'success' => 'Berhasil Absen Masuk pada jam ' . $jamFormatMonitoring . ' WIB (Status: ' . $statusDisplay . ')',
                'log_data' => [
                    'tanggal_teks' => $tanggalFormatMonitoring, 
                    'nama' => $namaUser,
                    'divisi' => $divisiUser,
                    'jam_masuk' => $jamFormatMonitoring, 
                    'jam_pulang' => '-',
                    'lokasi' => $request->input('latitude') . ',' . $request->input('longitude'),
                    'status' => $statusDisplay
                ]
            ]);
        } 
        
        if ($action === 'pulang') {
            try {
                Absensi::where('user_id', $userId)
                       ->where('tanggal', $tanggalIni)
                       ->update([
                           'jam_pulang' => $waktuSekarang
                       ]);
            } catch (\Exception $e) {}

            return redirect()->back()->with([
                'success' => 'Berhasil Absen Pulang pada jam ' . $jamFormatMonitoring . ' WIB',
                'log_data' => [
                    'tanggal_teks' => $tanggalFormatMonitoring, 
                    'nama' => $namaUser,
                    'divisi' => $divisiUser,
                    'jam_masuk' => 'Sudah', 
                    'jam_pulang' => $jamFormatMonitoring, 
                    'lokasi' => $request->input('latitude') . ',' . $request->input('longitude'),
                    'status' => 'Hadir'
                ]
            ]);
        }

        return redirect()->back();
    }
}