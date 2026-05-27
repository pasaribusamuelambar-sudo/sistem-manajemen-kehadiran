<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    // Tambahkan ini agar Controller bisa membaca 'absensis' dan 'pengajuanIzins'
    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'karyawan_id');
    }

    public function pengajuanIzins()
    {
        return $this->hasMany(PengajuanIzin::class, 'karyawan_id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}