<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donaturs';
    protected $fillable = ['nama','alamat','no_telpon'];

    public function scopeFilter($query,$filter = []){
        $query->when($filter['search'] ?? null, function($query,$search){
            $query->where('nama', 'like', '%'. $search .'%')
                ->orWhere('alamat', 'like', '%'. $search .'%')
                ->orWhere('no_telpon', 'like', '%'. $search .'%');
        });
    }
}
