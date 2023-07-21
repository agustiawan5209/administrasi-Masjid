<?php

namespace App\Http\Controllers;

use App\Models\DataDonatur;
use App\Models\KasMasjid;
use App\Models\SaldoDompet;
use Illuminate\Http\Request;

class SaldoDompetController extends Controller
{


    // Saldo Kas
    public function getSaldo()
    {
        $saldo = SaldoDompet::where('jenis_saldo', 'Kas')->latest()->first();
        if ($saldo == null) {
            $saldo = 0;
        } else {
            $saldo = SaldoDompet::where('jenis_saldo', 'Kas')->latest()->first()->total_saldo;
        }
        return $saldo;
    }


    public function store($kas_masuk, $kas_keluar)
    {
        $total_saldo = KasMasjid::sum('total_kas');
        SaldoDompet::create([
            'jenis_saldo'=> 'Kas',
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


    // Saldo Donatur

    public function getSaldoDonatur()
    {
        $saldo = SaldoDompet::where('jenis_saldo', 'Donatur')->latest()->first();
        if ($saldo == null) {
            $saldo = 0;
        } else {
            $saldo = SaldoDompet::where('jenis_saldo', 'Donatur')->latest()->first()->total_saldo;
        }
        return $saldo;
    }

    public function storeDonatur($kas_masuk, $kas_keluar)
    {
        $total_saldo = DataDonatur::sum('jumlah');
        SaldoDompet::create([
            'jenis_saldo'=> 'Donatur',
            'saldo_masuk' => $kas_masuk,
            'saldo_keluar' => $kas_keluar,
            'total_saldo' => $total_saldo,
        ]);
    }


    public function deleteSaldoDonatur($kas_masuk, $kas_keluar, $kas_masjid)
    {
        $saldo = $this->getSaldoDonatur();
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
