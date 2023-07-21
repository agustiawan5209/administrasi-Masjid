<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDonatur extends Model
{
    use HasFactory;

    protected $table = 'data_donaturs';
    protected $fillable = ['donatur_id', 'nama_donatur', 'jenis', 'jumlah', 'bukti', 'tanggal', 'ket'];

    protected $appends = [
        'path_bukti',
    ];

    public function pathBukti(): Attribute
    {
        return new Attribute(
            get: fn () => url('storage/buktidanadonatur/' . $this->bukti)
        );
    }


    // Relation
    public function donatur(){
        return $this->hasOne(Donatur::class, 'id','donatur_id');
    }
    /**
     * scopeFilter
     *  Query Builder Search
     * @param  mixed $query
     * @param  mixed $filter
     * @return void
     */
    public function scopeFilter($query, $filter = [])
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama_donatur', 'like', '%' . $search . '%')
                ->orWhere('jenis', 'like', '%' . $search . '%')
                ->orWhereDate('tanggal', 'like', '%' . $search . '%');
        });
    }
}
