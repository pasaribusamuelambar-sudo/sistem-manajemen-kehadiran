<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IzinController extends Controller
{
    /**
     * Menampilkan data pengajuan izin di sisi ADMIN
     */
    public function index()
    {
        // Ambil data perizinan dari database MySQL urut dari yang terbaru
        $izinData = Perizinan::orderBy('created_at', 'desc')->get();
        
        return view('auths.kelola_izin', compact('izinData'));
    }

    /**
     * Menampilkan data pengajuan izin di sisi KARYAWAN
     */
    public function karyawanIndex()
    {
        $user = Auth::user();

        // Jika user login ada, ambil data milik user tsb. Jika tidak, ambil semua
        if ($user) {
            $izinData = Perizinan::where('user_id', $user->id)
                ->orWhere('nama', $user->name)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $izinData = Perizinan::orderBy('created_at', 'desc')->get();
        }
        
        return view('auths.izin', compact('izinData'));
    }

    /**
     * Menyimpan data pengajuan izin BARU ke DATABASE
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_izin'    => 'required|string',
            'mulai'         => 'required|date',
            'selesai'       => 'required|date|after_or_equal:mulai',
            'alasan'        => 'required|string',
            'bukti_dokumen' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        $nama_file = null;
        if ($request->hasFile('bukti_dokumen')) {
            $file = $request->file('bukti_dokumen');
            $nama_file = $file->store('uploads/izin', 'public');
        }

        $user = Auth::user();

        // Simpan langsung ke database MySQL melalui Model Perizinan
        Perizinan::create([
            'user_id'       => $user ? $user->id : null,
            'nama'          => $user ? $user->name : 'Karyawan Aktif',
            'role'          => $user ? ($user->role ?? 'Karyawan') : 'Staff Teknis',
            'jenis_izin'    => $request->jenis_izin,
            'mulai'         => $request->mulai,
            'selesai'       => $request->selesai,
            'alasan'        => $request->alasan,
            'bukti'         => $nama_file,
            'status'        => 'Pending',
            'catatan_admin' => null
        ]);

        return redirect()->back()->with('success', 'Pengajuan permohonan izin baru berhasil dikirim dan tersimpan ke database!');
    }

    /**
     * Mengubah Status Izin oleh ADMIN di DATABASE
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'        => 'required|in:Pending,Disetujui,Ditolak',
            'catatan_admin' => 'required|string'
        ]);

        // Cari record perizinan di DB
        $izin = Perizinan::findOrFail($id);

        // Update data status & catatan admin
        $izin->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);

        return redirect()->back()->with('success', 'Keputusan otorisasi admin berhasil diperbarui di database!');
    }
}