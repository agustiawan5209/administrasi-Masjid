<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasis';
    protected $fillable = ['gambar', 'nama'];

    protected $appends= [
        'path_gambar',
    ];

    public function pathGambar(): Attribute
    {
        return new Attribute(
            get: fn()=> url( 'storage/struktur/' .$this->gambar),
        );
    }
}
