<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikels';
    protected $fillable = ['foto', 'judul','kategori', 'isi','tanggal'];

    protected $appends = [
        'path_foto',
    ];

    public function pathFoto() : Attribute
    {
        return new Attribute(
            get:fn()=> url('storage/artikel/'. $this->foto)
        );
    }


    // Filter
    public function scopeFilter($query,$filter= []){
        $query->when($filter['search'] ?? null,  function($query,$search){
            $query->where('judul', 'like', '%'. $search .'%')
                ->orWhere('kategori', 'like', '%'. $search .'%')
                ->orWhereDate('tanggal', 'like', '%'. $search .'%');
        });
    }
}
