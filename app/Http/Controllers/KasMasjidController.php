<?php

namespace App\Http\Controllers;

use App\Models\KasMasjid;
use App\Http\Requests\StoreKasMasjidRequest;
use App\Http\Requests\UpdateKasMasjidRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class KasMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Bendahara/KasMasjid/Index', [
            'kas' => KasMasjid::orderBy('id', 'desc')->filter(Request::only('search', 'high_kas', 'low_kas'))
                ->paginate(10),
            'search' => Request::input('search'),
            'high_kas' => Request::input('high_kas'),
            'low_kas' => Request::input('low_kas'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Bendahara/KasMasjid/Form', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKasMasjidRequest $request)
    {
        try {
            KasMasjid::create($request->all());
            return redirect()->route("KasMasjid.index")->with('success', "Berhasil Di Tambah");
        } catch (\Throwable $th) {
            return redirect()->route("KasMasjid.index")->with('errors', 'Gagal = '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KasMasjid $kasMasjid)
    {
        return Inertia::render('Bendahara/KasMasjid/Show', [
            'kas' => $kasMasjid->find(Request::input("slug"))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KasMasjid $kasMasjid)
    {
        return Inertia::render('Bendahara/KasMasjid/Show', [
            'kas' => $kasMasjid->find(Request::input("slug"))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKasMasjidRequest $request, KasMasjid $kasMasjid)
    {
        try {
            $kasMasjid->find(Request::input('slug'))->update($request->all());
            return redirect()->route("KasMasjid.index")->with('success', "Berhasil Di Edit");
        } catch (\Throwable $th) {
            return redirect()->route("KasMasjid.index")->with('errors', 'Gagal = '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KasMasjid $kasMasjid)
    {
        try {
            $kasMasjid->find(Request::input('slug'))->delete();
            return redirect()->route("KasMasjid.index")->with('success', "Berhasil Di Tambah");
        } catch (\Throwable $th) {
            return redirect()->route("KasMasjid.index")->with('errors', 'Gagal = '.$th->getMessage());
        }
    }
}
