<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Donatur;
use App\Models\DataDonatur;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDataDonaturRequest;
use App\Http\Requests\UpdateDataDonaturRequest;

class DataDonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saldo = new SaldoDompetController();
        return Inertia::render("Bendahara/DataDonatur/Index", [
            'data_donatur' => DataDonatur::orderBy('id', 'desc')->with(['donatur'])->filter(Request::only('search'))->paginate(10),
            'search' => Request::input('search'),
            'total_saldo'=> $saldo->getSaldoDonatur(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Bendahara/DataDonatur/Form', [
            'donatur' => Donatur::orderBy('id', 'desc')->get(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDataDonaturRequest $request)
    {
        $bukti = $request->file('bukti');
        $nama = md5($bukti->getClientOriginalName()) . '.' . $bukti->getClientOriginalExtension();
        $collect = $request->all();
        $collect['bukti'] = $nama;

        $bukti->storeAs('public', 'buktidanadonatur/' . $nama);

       $danadonatur= DataDonatur::create($collect);
       $saldo = new SaldoDompetController();
       $saldo->storeDonatur($danadonatur->jumlah,0);
        return redirect()->route('DataDonatur.index')->with('success', 'Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataDonatur $danadonatur)
    {
        return Inertia::render("Bendahara/DataDonatur/Show", [
            'data_donatur' => $danadonatur->find(Request::input('slug')),
            'donatur' => Donatur::orderBy('id', 'desc')->get(),

        ]);
    }
    public function GetDonatur(Donatur $donatur)
    {
        $data = $donatur->find(Request::input('id'));
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataDonatur $danadonatur)
    {
        return Inertia::render("Bendahara/DataDonatur/Edit", [
            'donatur' => Donatur::orderBy('id', 'desc')->get(),
            'data_donatur' => $danadonatur->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataDonaturRequest $request, DataDonatur $danadonatur)
    {
        $bukti_file = $danadonatur->find($request->slug)->bukti;
        $collect = $request->all();
        if ($request->file('bukti') !== null) {
            $this->imageDelete($bukti_file);
            $bukti = $request->file('bukti');
            $nama = md5($bukti->getClientOriginalName()) . '.' . $bukti->getClientOriginalExtension();
            $collect = $request->all();
            $collect['bukti'] = $nama;
        } else {
            $collect = $request->all();
            $collect['bukti'] = $bukti_file;
        }
        // dd($collect);
        $danadonatur = DataDonatur::find($request->slug)->update($collect);
        $saldo = new SaldoDompetController();
        $saldo->storeDonatur($danadonatur->jumlah,0);
        return redirect()->route('DataDonatur.index')->with('success', 'Berhasil Di Edit');
    }
    private function imageDelete($item)
    {
        $path = Storage::disk('public')->exists('buktidanadonatur/' . $item);
        if ($path) {
            Storage::disk('public')->delete('buktidanadonatur/' . $item);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(DataDonatur $danadonatur)
    {
        try {
            // Find Dana Doantur
            $danadonatur = $danadonatur->find(Request::input('slug'));
            // Find Foto By ID
            $foto_artikel = $danadonatur->foto;

            // Delete Image
            $this->imageDelete($foto_artikel);
            // Delete Data Donatur
            $danadonatur->delete();

            // Delete Saldo Donatur;
            $saldo = new SaldoDompetController();
            $saldo->deleteSaldoDonatur($danadonatur->jumlah,0, $danadonatur->jumlah);

            return redirect()->route('DataDonatur.index')->with('success', 'Berhasil Di Hapus');
        } catch (\Throwable $th) {
            return redirect()->route('DataDonatur.index')->with('errors', $th->getMessage());
        }
    }
}
