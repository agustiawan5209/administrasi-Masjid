<?php

namespace App\Http\Controllers;

use App\Models\KasMasjid;
use App\Models\SaldoDompet;
use Illuminate\Http\Request;

class SaldoDompetController extends Controller
{
    public function getSaldo()
    {
        $saldo = SaldoDompet::latest()->first();
        if ($saldo == null) {
            $saldo = 0;
        } else {
            $saldo = SaldoDompet::latest()->first()->total_saldo;
        }
        return $saldo;
    }

    public function store($kas_masuk, $kas_keluar)
    {
        $total_saldo = KasMasjid::sum('total_kas');
        SaldoDompet::create([
            'saldo_masuk' => $kas_masuk,
            'saldo_keluar' => $kas_keluar,
            'total_saldo' => $total_saldo,
        ]);
    }

    public function deleteKas($kas_masuk, $kas_keluar, $kas_masjid)
    {
        $saldo = $this->getSaldo();
        if ($saldo < 1) {

            $total_saldo = 0;
        } else {

            $total_saldo = intval($saldo - $kas_masjid);
        }
        SaldoDompet::create([
            'saldo_masuk' => $kas_masuk,
            'saldo_keluar' => $kas_keluar,
            'total_saldo' => $total_saldo,
        ]);
    }
}
