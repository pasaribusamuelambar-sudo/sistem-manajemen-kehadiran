<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;

    protected $table = 'perizinans';

    protected $fillable = [
        'user_id',
        'nama',
        'role',
        'jenis_izin',
        'mulai',
        'selesai',
        'alasan',
        'bukti',
        'status',
        'catatan_admin'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}