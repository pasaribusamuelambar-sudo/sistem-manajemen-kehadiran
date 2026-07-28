<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perizinans', function (Blueprint $table) {
            $table->id();
            // Relasi opsional ke tabel users
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('role')->default('Karyawan');
            $table->string('jenis_izin');
            $table->date('mulai');
            $table->date('selesai');
            $table->text('alasan');
            $table->string('bukti')->nullable();
            $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perizinans');
    }
};