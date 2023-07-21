<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasjid extends Model
{
    use HasFactory;

    protected $table = "kas_masjids";
    protected $fillable = ['kode', 'tanggal', 'kas_masuk', 'ket_kas_masuk', 'kas_keluar', 'ket_kas_keluar', 'total_kas'];

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
        })->when($filter['high_kas'] ?? null, function ($query) {
            $query->orderBy('total_kas', 'desc');
        })->when($filter['low_kas'] ?? null, function ($query) {
            $query->orderBy('total_kas', 'asc');
        });
    }

    public function scopeDateFilter($query,$filter = [])
    {
        $query->when($filter['max_date'] ?? null && $filter['min_date'] ?? null, function($query) use($filter){
            $query->whereBetween('tanggal', [$filter['max_date'],$filter['min_date']]);
        });
    }
    public function scopeMonthFilter($query,$month)
    {
        $query->when($month ?? null, function($query) use($month){
            $query->whereMonth('tanggal', $month);
        });
    }
}
