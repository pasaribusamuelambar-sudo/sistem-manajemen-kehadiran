<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensinya';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status_masuk',
        'lokasi',
    ];

    // Relasi untuk mengambil nama karyawan
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}