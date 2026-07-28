<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Menghilangkan warning Auth
use Illuminate\Support\Facades\Hash; // Menghilangkan warning Hash
use App\Models\User; // Menghilangkan warning User

class KaryawanProfilController extends Controller
{
    /**
     * 1. FUNGSI TAMPILKAN (Mengirimkan data user riil dari database ke file view)
     */
    public function tampilkan(Request $request)
    {
        // Mengambil data user yang sedang login langsung dari database MySQL
        $user = Auth::user();

        // Membuat array backup agar kompatibel dengan variabel $karyawan di view lama Anda
        $profilArray = [
            'id_karyawan'  => $user->id_kerja,
            'nama_lengkap' => $user->name,
            'jabatan'      => $user->role === 'karyawan' ? 'Staff/Karyawan' : 'Admin',
            'divisi'       => $user->divisi,
            'kontak_email' => $user->email,
            'status'       => $user->status
        ];

        // Ambil parameter 'page' dari URL. Jika kosong, default ke 'profil'
        $currentPage = $request->query('page', 'profil');

        // Kirimkan semua variabel yang dibutuhkan oleh auths/profil_karyawan.blade.php
        return view('auths.profil_karyawan', [
            'user'     => $user, 
            'karyawan' => $profilArray,  
            'page'     => $currentPage   
        ]);
    }

    /**
     * 2. FUNGSI UPDATE PROFIL (Menangani request tombol simpan perubahan data diri ke database)
     */
    public function updateProfil(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'kontak_email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update data ke database MySQL
        $user->update([
            'name'  => $request->nama_lengkap,
            'email' => $request->kontak_email,
        ]);

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * 3. FUNGSI UPDATE SANDI (Menangani request ganti kata sandi karyawan)
     */
    public function updateSandi(Request $request)
    {
        $request->validate([
            'sandi_lama' => 'required',
            'sandi_baru' => 'required|min:8|confirmed', // Sesuai standar minimal 8 karakter
        ]);

        $user = User::find(Auth::id());

        // Cek kesesuaian sandi lama menggunakan Facade Hash yang sudah di-import
        if (!Hash::check($request->sandi_lama, $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi lama Anda tidak sesuai.');
        }

        // Jalankan update ganda (Bcrypt untuk sistem, teks asli agar bisa dipantau admin)
        $user->update([
            'password'      => Hash::make($request->sandi_baru),
            'real_password' => $request->sandi_baru
        ]);
        
        return redirect()->back()->with('success', 'Kata sandi pengaman Anda berhasil diubah!');
    }
}