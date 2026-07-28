<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKerja extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kerjas';

    protected $fillable = [
        'divisi',
        'hari',
        'jam_masuk',
        'jam_pulang',
        'toleransi'
    ];
}