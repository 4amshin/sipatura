<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Http\Requests\StoreSuratKeluarRequest;
use App\Http\Requests\UpdateSuratKeluarRequest;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarSuratKeluar = SuratKeluar::orderBy('tanggal_keluar', 'desc')->get();

        return view('admin.surat_keluar.daftar_surat_keluar', compact('daftarSuratKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surat_keluar.tambah_surat_keluar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratKeluarRequest $request)
    {
        $validatedData = $request->validated();

        SuratKeluar::create($validatedData);

        return redirect()->route('suratKeluar.index')->with('success', 'Surat Keluar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        return view('admin.surat_keluar.update_surat_keluar', compact('suratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratKeluarRequest $request, SuratKeluar $suratKeluar)
    {
        $validatedData = $request->validated();

        $suratKeluar->update($validatedData);

        return redirect()->route('suratKeluar.index')->with('success', 'Data Surat Keluar DiPerbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        $suratKeluar->delete();

        return redirect()->route('suratKeluar.index')->with('success', 'Data Surat Keluar Telah Dihapus');
    }
}
