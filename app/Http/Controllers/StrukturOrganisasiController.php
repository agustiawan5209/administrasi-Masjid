<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/StrukturOrganisasi/Index',[
            'struktur'=> StrukturOrganisasi::latest()->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'nullable|string',
            'gambar'=> 'required|image|max:1020',
        ]);
        $file = $request->file('gambar');
        $nama = md5($file->getClientOriginalName());

        $file->storeAs('public', 'struktur/'. $nama);
        StrukturOrganisasi::create([
            'nama'=>$request->nama,
            'gambar'=> $nama,
        ]);
        return redirect()->route('Struktur.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $request->validate([
            'nama'=> 'nullable|string',
            'gambar'=> 'required|image|max:1020',
        ]);
        $file = $request->file('gambar');
        $nama = md5($file->getClientOriginalName());
        StrukturOrganisasi::where('id', $request->slug)->update([
            'nama'=>$request->nama,
            'gambar'=> $nama,
        ]);
        return redirect()->route('Struktur.index')->with('success', 'Berhasil Di Ganti');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StrukturOrganisasi $strukturOrganisasi, Request $request)
    {
        $strukturOrganisasi->find($request->slug)->delete();
        return redirect()->route('Struktur.index')->with('success', 'Berhasil Di Hapus');

    }
}
