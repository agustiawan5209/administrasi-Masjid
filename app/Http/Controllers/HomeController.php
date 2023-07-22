<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\TabelShalat;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tanggal =  Carbon::now()->format('Y-m-d');
        $jadwal_shalat = TabelShalat::orderBy('jam','asc')->where('jenis','shalat_wajib')->where('tanggal', $tanggal)->paginate(5);
        // dd($jadwal_shalat);
        return Inertia::render('Welcome', [
            'jadwal_shalat' => TabelShalat::orderBy('jam','asc')->where('jenis','shalat_wajib')->where('tanggal', $tanggal)->paginate(5),
            'jadwal_kajian' => Kajian::orderBy('waktu','asc')->where('tanggal', $tanggal)->get(),
        ]);
    }
}
