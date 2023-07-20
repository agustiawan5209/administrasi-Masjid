<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    use HasFactory;

    protected $table = 'kajians';
    protected $fillable = ['judul', 'uztadz', 'tanggal', 'ket', 'penanggung_jawab'];

    public function scopeFilter($query, $filter = [])
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('uztadz', 'like', '%' . $search . '%')
                ->orWhereDate('tanggal', 'like', '%' . $search . '%')
                ->orWhere('ket', 'like', '%' . $search . '%')
                ->orWhere('penanggung_jawab', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
