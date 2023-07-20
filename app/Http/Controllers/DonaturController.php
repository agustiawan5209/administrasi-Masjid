<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Donatur;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreDonaturRequest;
use App\Http\Requests\UpdateDonaturRequest;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Donatur/Index', [
            'donatur' => Donatur::orderBy('id', 'desc')->filter(Request::only('search'))->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Donatur/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonaturRequest $request)
    {
        try {
            Donatur::create($request->all());
            return redirect()->route('Donatur.index')->with('success', 'Berhasil Di Tambah');
        } catch (\Throwable $th) {
            return redirect()->route('Donatur.index')->with('errors', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Donatur $donatur)
    {
        return Inertia::render("Admin/Donatur/Show", [
            'donatur' => $donatur->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donatur $donatur)
    {
        return Inertia::render("Admin/Donatur/Edit", [
            'donatur' => $donatur->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonaturRequest $request, Donatur $donatur)
    {
        try {
            $donatur->find($request->slug)->update($request->all());
            return redirect()->route('Donatur.index')->with('success', 'Berhasil Di Edit');
        } catch (\Throwable $th) {
            return redirect()->route('Donatur.index')->with('errors', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donatur $donatur)
    {
        try {
            $donatur->find(Request::input('slug'))->delete();
            return redirect()->route('Donatur.index')->with('success', 'Berhasil Di Hapus');
        } catch (\Throwable $th) {
            return redirect()->route('Donatur.index')->with('errors', $th->getMessage());
        }
    }
}
