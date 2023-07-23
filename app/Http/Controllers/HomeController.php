<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kajian;
use App\Models\TabelShalat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
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

    public function artikel(){
        $this_month = Carbon::now()->format('m');
        return Inertia::render('Artikel', [
            'artikel_relate' => Artikel::orderBy('id', 'desc')->paginate(10),
            'latest_artikel' => Artikel::orderBy('id', 'desc')->paginate(10),
            'artikel_terbaru' => Artikel::latest()->first(),
            'artikel_terbaru' => Artikel::whereMonth('tanggal',$this_month)->paginate(10),
        ]);
    }

    public function showArtikel(){
        return Inertia::render('ArtikelShow', [
            'artikel' => Artikel::find(Request::input('slug')),
        ]);
    }
}
