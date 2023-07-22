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
        return Inertia::render('Admin/Shalat/Index',[
            'jadwal'=> TabelShalat::orderBy('id','desc')->filter(Request::only('jenis'))->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Shalat/Form',[
            'jadwal'=> TabelShalat::orderBy('id','desc')->filter(Request::only('jenis'))->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTabelShalatRequest $request)
    {
        $tabelShalat = TabelShalat::create($request->all());

        return redirect()->route('JadwalShalat.index')->with('success','Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(TabelShalat $tabelShalat)
    {
        return Inertia::render('Admin/Shalat/Show',[
            'jadwal'=> TabelShalat::find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TabelShalat $tabelShalat)
    {
        return Inertia::render('Admin/Shalat/Edit',[
            'jadwal'=> TabelShalat::find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTabelShalatRequest $request, TabelShalat $tabelShalat)
    {
        $tabelShalat->find(Request::input('slug'))->update($request->all());

        return redirect()->route('JadwalShalat.index')->with('success','Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TabelShalat $tabelShalat)
    {
        $tabelShalat->find(Request::input('slug'))->delete();
        return redirect()->route('JadwalShalat.index')->with('success','Berhasil Di Hapus');
    }
}
