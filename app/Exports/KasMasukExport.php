<?php

namespace App\Exports;

use App\Models\KasMasjid;
use Maatwebsite\Excel\Concerns\FromCollection;

class KasMasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KasMasjid::all();
    }
}
