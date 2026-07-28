<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memasukkan akun Admin Utama ke dalam sistem database secara otomatis
        User::updateOrCreate(
            ['email' => 'pasaribusamuelambar@gmail.com'], // Mencegah duplikasi data
            [
                'id_kerja'      => 'ADM-001',
                'name'          => 'Samuel Pasaribu',
                'divisi'        => 'IT Core / Administrator',
                'no_hp'         => '081234567890',
                'password'      => Hash::make('12345678'), // Enkripsi keamanan login Laravel
                'real_password' => '12345678',             // Teks asli pantauan database
                'role'          => 'admin_super',          // Hak akses tertinggi untuk mengelola karyawan
                'status'        => 'Aktif',
            ]
        );
    }
}