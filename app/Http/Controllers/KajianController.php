<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Http\Requests\StoreKajianRequest;
use App\Http\Requests\UpdateKajianRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class KajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Kajian/Index', [
            'kajian'=> Kajian::orderBy('id','desc')->filter(Request::only('search', 'order'))->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Kajian/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKajianRequest $request)
    {
        Kajian::create($request->all());
        return redirect()->route('Kajian.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kajian $kajian)
    {
        return Inertia::render('Admin/Kajian/Show', [
            'kajian'=> $kajian->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kajian $kajian)
    {
        return Inertia::render('Admin/Kajian/Edit', [
            'kajian'=> $kajian->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKajianRequest $request, Kajian $kajian)
    {
        $kajian->find(Request::input('slug'))->update($request->all());
        return redirect()->route('Kajian.index')->with('success', 'Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Kajian $kajian)
    {
        $kajian->find(Request::input('slug'))->delete();
        return redirect()->route('Kajian.index')->with('success', 'Berhasil Di Hapus');
    }
}
