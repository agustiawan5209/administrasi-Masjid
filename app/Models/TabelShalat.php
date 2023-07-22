<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelShalat extends Model
{
    use HasFactory;

    protected $table = 'tabel_shalats';
    protected $fillable = ['jenis', 'tanggal', 'hari', 'waktu', 'jam', 'muadzin', 'khotbah', 'imam',];


    public function scopeFilter($query, $filter = [])
    {
        $query->when($filter['jenis'] ?? null, function ($query, $jenis) {
            $query->where('jenis', '=', $jenis);
        });
    }
}
