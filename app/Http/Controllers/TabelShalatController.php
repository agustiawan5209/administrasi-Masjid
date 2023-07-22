<?php

namespace App\Http\Controllers;

use App\Models\TabelShalat;
use App\Http\Requests\StoreTabelShalatRequest;
use App\Http\Requests\UpdateTabelShalatRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TabelShalatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Shalat/Index', [
            'jadwal' => TabelShalat::orderBy('id', 'desc')->filter(['jenis'=>'shalat_wajib'])->get(),
            'jadwal_jumat' => TabelShalat::orderBy('id', 'desc')->filter(['jenis'=>'jumat'])->paginate(10),
            'jenis'=> Request::input('jenis', 'shalat_wajib')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Shalat/Form', [
            'jadwal' => TabelShalat::orderBy('id', 'desc')->filter(Request::only('jenis'))->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTabelShalatRequest $request)
    {

        if ($request->jenis == 'shalat_wajib') {
            $tabel_shalat = TabelShalat::where('tanggal', $request->tanggal)->where('jenis','shalat_wajib')->get();
            if($tabel_shalat->count() > 1){
                return redirect()->route('JadwalShalat.index')->with('error', 'Gagal= Tanggal Sudah Ada, Mohon Edit Jika Ingin Mengubah')->with('jenis', $request->jenis);
            }else{
                $waktu_array = collect($request->waktu_array);
            $tabel_shalat = [];
            for ($i = 0; $i < count($waktu_array); $i++) {
                $tabel_shalat[$i] = [
                    'jenis' => $request->jenis,
                    'tanggal' => $request->tanggal,
                    'hari' => $request->hari,
                    'jam' => $request->jam_array[$i],
                    'waktu' => $waktu_array[$i],
                ];
            }
            TabelShalat::insert($tabel_shalat);
            }
        } else {
            TabelShalat::create($request->all());
        }
        return redirect()->route('JadwalShalat.index')->with('success', 'Berhasil Di Tambah')->with('jenis', $request->jenis);
    }

    /**
     * Display the specified resource.
     */
    public function show(TabelShalat $tabelShalat)
    {
        return Inertia::render('Admin/Shalat/Show', [
            'jadwal' => TabelShalat::where('jenis', 'shalat_wajib')->whereDate('tanggal', Request::input('tanggal'))->get(),
            'tanggal'=> Request::input('tanggal')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TabelShalat $tabelShalat)
    {
        return Inertia::render('Admin/Shalat/Edit', [
            'jadwal' => TabelShalat::where('tanggal',Request::input('tanggal'))->paginate(5),
        ]);
    }
    public function edit_jumat(TabelShalat $tabelShalat)
    {
        return Inertia::render('Admin/Shalat/EditJumat', [
            'jadwal' => TabelShalat::find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTabelShalatRequest $request, TabelShalat $tabelShalat)
    {
        $waktu_array = collect($request->waktu_array);
        $tabel_shalat = [];
        for ($i = 0; $i < count($waktu_array); $i++) {
            $tabel_shalat[$i] = [
                'jenis' => $request->jenis,
                'tanggal' => $request->tanggal,
                'hari' => $request->hari,
                'jam' => $request->jam_array[$i],
                'waktu' => $waktu_array[$i],
            ];
        }
        $tabelShalat = TabelShalat::where('jenis','shalat_wajib')->where('tanggal',Request::input('tanggal'))->get();
        foreach ($tabelShalat as $key => $value) {
            TabelShalat::find($value->id)->update($tabel_shalat[$key]);
        }

        return redirect()->route('JadwalShalat.index')->with('success', 'Berhasil Di Edit')->with('jenis', 'shalat_wajib');
    }

    public function updateJumat(UpdateTabelShalatRequest $request, TabelShalat $tabelShalat)
    {
        $tabelShalat->find(Request::input('slug'))->update($request->all());

        return redirect()->route('JadwalShalat.index')->with('success', 'Berhasil Di Edit')->with('jenis', 'jumat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TabelShalat $tabelShalat)
    {
        $tabelShalat->whereDate('tanggal',Request::input('slug'))->where('jenis','shalat_wajib')->delete();
        return redirect()->route('JadwalShalat.index')->with('success', 'Berhasil Di Hapus')->with('jenis', 'shalat_wajib');
    }
    public function destroyJumat(TabelShalat $tabelShalat)
    {
        $tabelShalat->find(Request::input('slug'))->delete();
        return redirect()->route('JadwalShalat.index')->with('success', 'Berhasil Di Hapus')->with('jenis', 'jumat');
    }
}
