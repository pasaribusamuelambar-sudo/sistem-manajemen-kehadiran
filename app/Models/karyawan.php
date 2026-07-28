<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'karyawans';

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = [
        'id_kerja',
        'name',
        'email',
        'password',
        'real_password',
        'no_hp',
        'divisi',
        'role',
        'status'
    ];
}