<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use Illuminate\Support\Facades\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Pengumuman/Index', [
            'artikel' => Artikel::orderBy('id', 'desc')->filter(Request::only('search'))->paginate(10),
            'search'=> Request::input('search')

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Pengumuman/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtikelRequest $request)
    {
        $foto = $request->file('foto');
        $nama = md5($foto->getClientOriginalName()) . '.' . $foto->getClientOriginalExtension();
        $collect = $request->all();
        $collect['foto'] = $nama;

        $foto->storeAs('public', 'artikel/' . $nama);
        Artikel::create($collect);
        return redirect()->route('Artikel.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return Inertia::render('Admin/Pengumuman/Show', [
            'artikel' => $artikel->find(Request::input('slug'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        return Inertia::render('Admin/Pengumuman/Edit', [
            'artikel' => $artikel->find(Request::input('slug'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $foto_artikel = $artikel->find($request->slug)->foto;
        $collect = $request->all();
        if($request->file('foto') !== null){
            $this->imageDelete($foto_artikel);
            $foto = $request->file('foto');
            $nama = md5($foto->getClientOriginalName()) . '.' . $foto->getClientOriginalExtension();
            $collect = $request->all();
            $collect['foto'] = $nama;
        }else{
            $collect = $request->all();
            $collect['foto'] = $foto_artikel;
        }
        $artikel->find($request->slug)->update($collect);
        return redirect()->route('Artikel.index')->with('success', 'Berhasil Di Edit');


    }
    private function imageDelete($item)
    {
        $path = Storage::disk('public')->exists('artikel/' . $item);
        if ($path) {
            Storage::disk('public')->delete('artikel/' . $item);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel = $artikel->find(Request::input('slug'));
        $foto_artikel = $artikel->foto;
        $this->imageDelete($foto_artikel);
        $artikel->delete();
        return redirect()->route('Artikel.index')->with('success', 'Berhasil Di Hapus');


    }
}
