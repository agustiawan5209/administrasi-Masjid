<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoDompet extends Model
{
    use HasFactory;

    protected $table = 'saldo_dompets';
    protected $fillable = ['saldo_masuk', 'saldo_keluar', 'total_saldo'];
}
