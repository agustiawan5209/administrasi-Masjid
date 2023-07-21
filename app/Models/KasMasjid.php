<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasjid extends Model
{
    use HasFactory;

    protected $table = "kas_masjids";
    protected $fillable = ['kode','tanggal', 'kas_masuk', 'ket_kas_masuk', 'kas_keluar', 'ket_kas_keluar', 'total_kas'];

    protected $appends = [
        'total_saldo',
    ];

    public function totalSaldo(): Attribute
    {
        return new Attribute(
            get: fn () => $this->kas_masuk + $this->kas_keluar
        );
    }

    public function scopeFilter($query, $filter = [])
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('kode', 'like', '%' . $search . '%')
                ->orWhere('ket_kas_masuk', 'like', '%' . $search . '%')
                ->orWhere('ket_kas_keluar', 'like', '%' . $search . '%');
        })
            ->when($filter['high_kas'] || $filter['low_kas'] ?? null, function ($query, $high_kas, $low_kas) {
                $query->whereBetween('total_kas', [$high_kas, $low_kas]);
            });
    }
}
