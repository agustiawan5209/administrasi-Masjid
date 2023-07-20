<?php

namespace App\Http\Controllers;

use App\Models\JadwalKegiatan;
use App\Http\Requests\StoreJadwalKegiatanRequest;
use App\Http\Requests\UpdateJadwalKegiatanRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class JadwalKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/KegiatanJadwal/Index',[
            'jadwal'=> JadwalKegiatan::orderBy('id','desc')->paginate(10),
            'search'=> Request::input('search')

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/KegiatanJadwal/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJadwalKegiatanRequest $request)
    {
        JadwalKegiatan::create($request->all());
        return redirect()->route('Kegiatan.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKegiatan $jadwalKegiatan)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKegiatan $jadwalKegiatan)
    {
        return Inertia::render('Admin/KegiatanJadwal/Edit', [
            'jadwal'=> $jadwalKegiatan->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalKegiatanRequest $request, JadwalKegiatan $jadwalKegiatan)
    {
        $jadwalKegiatan->find(Request::input('id'))->update($request->all());
        return redirect()->route('Kegiatan.index')->with('success', 'Berhasil Di Edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(JadwalKegiatan $jadwalKegiatan)
    {
        $jadwalKegiatan->find(Request::input('slug'))->delete();
        return redirect()->route('Kegiatan.index')->with('success', 'Berhasil Di Hapus');

    }
}
