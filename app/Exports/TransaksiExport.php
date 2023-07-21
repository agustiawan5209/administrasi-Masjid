<?php

namespace App\Exports;

use App\Models\KasMasjid;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Illuminate\Contracts\View\View;

class TransaksiExport implements FromView
{

    public $filter;
    public function __construct($filterDate = [])
    {
        $this->filter = $filterDate;
    }

    public function view(): View
    {
        return view('exports-kas', [
            'kas' => KasMasjid::select('kode', 'tanggal', 'kas_masuk', 'ket_kas_masuk', 'kas_keluar', 'ket_kas_keluar', 'total_kas')
                ->dateFilter($this->filter)
                ->get(),
        ]);
    }
}
