<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kegiatans';
    protected $fillable = [
        'tanggal',
        'waktu',
        'kegiatan',
        'tempat',
        'ket',
        'penanggung_jawab',
    ];
}
