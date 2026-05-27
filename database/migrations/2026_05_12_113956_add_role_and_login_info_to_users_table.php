<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role untuk membedakan Admin dan Karyawan
            // Default diset ke 'karyawan' agar lebih aman
            $table->string('role')->default('karyawan')->after('password');

            // Menambahkan kolom untuk mencatat waktu login terakhir secara otomatis
            $table->timestamp('last_login_at')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['role', 'last_login_at']);
        });
    }
};