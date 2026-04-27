<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambah kolom role.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kita tambahkan kolom role setelah kolom password
            // Nilai defaultnya 'karyawan' agar tidak error saat ada user baru
            $table->string('role')->default('karyawan')->after('password');
        });
    }

    /**
     * Batalkan migrasi (hapus kolom role jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};