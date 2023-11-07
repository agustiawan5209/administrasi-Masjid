<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\JadwalKegiatan;
use App\Models\Kajian;
use App\Models\KasMasjid;
use App\Models\StrukturOrganisasi;
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
        $latest_artikel = Artikel::latest()->first();
        return Inertia::render('Artikel', [
            'latest_artikel' => $latest_artikel,
            'artikel_relate' => Artikel::where('kategori', '=', $latest_artikel->kategori)->orderBy('id', 'desc')->paginate(5),
            'artikel_terbaru' => Artikel::whereMonth('tanggal',$this_month)->paginate(10),
        ]);
    }
    public function Struktur(){
        return Inertia::render('Struktur', [
            'struktur'=> StrukturOrganisasi::orderBy('id','desc')->latest()->first(),
        ]);
    }
    public function laporankas(){
        return Inertia::render('LaporanKas', [
            'kas'=> KasMasjid::orderBy('id','desc')->get(),
        ]);
    }
    public function kegiatan(){
        $carbon = Carbon::now();
        $this_day = Carbon::now()->format('d');
        $this_month = Carbon::now()->format('m');
        $next_month = $carbon->addMonth()->format('m');
        $kegiatan_hari_ini = JadwalKegiatan::whereDay('tanggal', $this_day)->get();
        $kegiatan = JadwalKegiatan::whereMonth('tanggal', '=', $this_month)->whereDay('tanggal', '>' ,$this_day)->get();
        if($kegiatan->count() < 1){
            $kegiatan = JadwalKegiatan::whereMonth('tanggal', '=', $next_month)->get();
        }
        $semua_kegiatan = JadwalKegiatan::all();
        // dd($semua_kegiatan);
        // dd($kegiatan_hari_ini);
        return Inertia::render('Kegiatan', [
            'kegiatan_hari_ini' => $kegiatan_hari_ini,
            'kegiatan_bulan_ini'=> $kegiatan,
            'semua_kegiatan'=> $semua_kegiatan,
        ]);
    }
    public function kajian(){
        $this_day = Carbon::now()->format('d');
        $this_month = Carbon::now()->format('m');
        $kajian_hari_ini = Kajian::whereDay('tanggal', $this_day)->get();
        $kajian = Kajian::all();
        return Inertia::render('Kajian', [
            'kajian' => $kajian,
            'kajian_hari_ini' => $kajian_hari_ini,
            'kajian_bulan_ini'=> Kajian::whereMonth('tanggal', '=', $this_month)->whereDay('tanggal', '>' ,$this_day)->get(),
        ]);
    }

    public function showArtikel($tanggal){
        $artikel = Artikel::find(Request::input('slug'));
        return Inertia::render('DetailArtikel', [
            'artikel' => $artikel,
            'tanggal'=> $tanggal,
            'artikel_relate' => Artikel::where('kategori', '=', $artikel->kategori)->orderBy('id', 'desc')->paginate(5),

        ]);
    }
}
