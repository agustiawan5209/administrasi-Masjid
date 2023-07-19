<?php

namespace App\Http\Controllers;

use App\Models\JadwalKegiatan;
use App\Http\Requests\StoreJadwalKegiatanRequest;
use App\Http\Requests\UpdateJadwalKegiatanRequest;
use Inertia\Inertia;

class JadwalKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/KegiatanJadwal/Index',[
            'kegiatan'=> JadwalKegiatan::paginate(10),
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKegiatan $jadwalKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKegiatan $jadwalKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalKegiatanRequest $request, JadwalKegiatan $jadwalKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKegiatan $jadwalKegiatan)
    {
        //
    }
}
