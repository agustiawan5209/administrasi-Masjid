<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use Inertia\Inertia;
use App\Models\KasMasjid;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\SaldoDompetController;

class LaporanController extends Controller
{

    /**
     * LaporanKeuangan
     * View Laporan Keuangan
     * @return void
     */
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

    public function generateLaporanKeuanganExcel()
    {
        $nama_file = 'laporan_kas_masjid_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new TransaksiExport(Request::only('max_date', 'min_date')), $nama_file, null, [\Maatwebsite\Excel\Excel::XLSX]);
    }
    public function generateLaporanKeuanganPDF()
    {
        $nama_file = 'laporan_kas_masjid_' . date('Y-m-d_H-i-s') . '.pdf';
        return Excel::download(new TransaksiExport(Request::only('max_date', 'min_date')), $nama_file,  \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
