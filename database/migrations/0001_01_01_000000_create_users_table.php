<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_kerja')->unique(); // EMP-XXXX
            $table->string('name');
            $table->string('email')->unique();
            $table->string('divisi')->default('Staff');
            $table->string('no_hp')->nullable();
            $table->string('password');
            $table->string('real_password')->nullable(); // Untuk pantauan admin
            $table->enum('role', ['admin_super', 'admin_eksekutif', 'admin_operasional', 'karyawan'])->default('karyawan');
            $table->string('status')->default('Aktif');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};