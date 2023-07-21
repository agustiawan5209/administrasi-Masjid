<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\KasMasjid;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\SaldoDompetController;

class LaporanController extends Controller
{

    public function LaporanKeuangan()
    {
        $saldo = new SaldoDompetController();
        return Inertia::render('Bendahara/Laporan/Index', [
            'kas' => KasMasjid::orderBy('id', 'desc')->filter(Request::only('search', 'high_kas', 'low_kas'))
                ->dateFilter(Request::only('max_date', 'min_date'))
                ->monthFilter(Request::input('month'))
                ->get(),
            'search' => Request::input('search'),
            'month' => Request::input('month'),
            'high_kas' => Request::input('high_kas'),
            'low_kas' => Request::input('low_kas'),
            'total_saldo' => $saldo->getSaldo(),
        ]);
    }
}
