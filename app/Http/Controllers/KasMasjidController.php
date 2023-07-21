<?php

namespace App\Http\Controllers;

use App\Models\KasMasjid;
use App\Http\Requests\StoreKasMasjidRequest;
use App\Http\Requests\UpdateKasMasjidRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Nette\Utils\Random;

class KasMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saldo = new SaldoDompetController();
        return Inertia::render('Bendahara/Transaksi/Index', [
            'kas' => KasMasjid::orderBy('id', 'desc')->filter(Request::only('search', 'high_kas', 'low_kas'))
                ->paginate(10),
            'search' => Request::input('search'),
            'high_kas' => Request::input('high_kas'),
            'low_kas' => Request::input('low_kas'),
            'total_saldo' => $saldo->getSaldo(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Bendahara/Transaksi/Form', [
            'kode' => $this->GenerateKode()
        ]);
    }
    private function GenerateKode()
    {
        $kode = Random::generate(10, '0-9A-Z');
        $kas_kode = KasMasjid::where('kode', $kode)->get();
        if ($kas_kode->count() > 1) {
            $kode = Random::generate(10, '0-9A-Z');
        }
        return $kode;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKasMasjidRequest $request)
    {
        try {
            $kasMasjid = KasMasjid::create($request->all());
            $saldo = new SaldoDompetController();
            $saldo->store($kasMasjid->kas_masuk, $kasMasjid->kas_keluar);
            return redirect()->route("KasMasjid.index")->with('success', "Berhasil Di Tambah");
        } catch (\Exception $th) {
            return redirect()->route("KasMasjid.index")->with('errors', 'Gagal = ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KasMasjid $kasMasjid)
    {
        return Inertia::render('Bendahara/Transaksi/Show', [
            'kas' => $kasMasjid->find(Request::input("slug"))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KasMasjid $kasMasjid)
    {
        return Inertia::render('Bendahara/Transaksi/Edit', [
            'kas' => $kasMasjid->find(Request::input("slug"))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKasMasjidRequest $request, KasMasjid $kasMasjid)
    {
        try {
            $kasMasjid = KasMasjid::find(Request::input('slug'))->update($request->all());
            $saldo = new SaldoDompetController();
            $saldo->store($kasMasjid->kas_masuk, $kasMasjid->kas_keluar);
            return redirect()->route("KasMasjid.index")->with('success', "Berhasil Di Edit");
        } catch (\Exception $th) {
            return redirect()->route("KasMasjid.index")->with('errors', 'Gagal = ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(KasMasjid $kasMasjid)
    {
        $kasMasjid = KasMasjid::find(Request::input('slug'));

        $saldo = new SaldoDompetController();

        $saldo->deleteKas($kasMasjid->kas_masuk, $kasMasjid->kas_keluar, $kasMasjid->total_kas);

        $kasMasjid->delete();
        return redirect()->route("KasMasjid.index")->with('success', "Berhasil Di Tambah");
    }
}
