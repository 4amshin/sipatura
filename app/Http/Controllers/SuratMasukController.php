<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Http\Requests\StoreSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarSuratMasuk = SuratMasuk::orderBy('tanggal_masuk', 'desc')->get();

        return view('admin.surat_masuk.daftar_surat_masuk', compact('daftarSuratMasuk'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surat_masuk.tambah_surat_masuk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratMasukRequest $request)
    {
        $validatedData = $request->validated();

        SuratMasuk::create($validatedData);

        return redirect()->route('suratMasuk.index')->with('success', 'Surat Masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('admin.surat_masuk.update_surat_masuk', compact('suratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratMasukRequest $request, SuratMasuk $suratMasuk)
    {
        $validatedData = $request->validated();

        $suratMasuk->update($validatedData);

        return redirect()->route('suratMasuk.index')->with('success', 'Data Surat Masuk DiPerbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        $suratMasuk->delete();

        return redirect()->route('suratMasuk.index')->with('success', 'Data Surat Masuk Telah Dihapus');
    }
}
