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
        $daftarSuratKeluar = SuratKeluar::all();

        return view('admin.surat_keluar.surat_keluar', compact('daftarSuratKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratKeluarRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratKeluarRequest $request, SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        //
    }
}
