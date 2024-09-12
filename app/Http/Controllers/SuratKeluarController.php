<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Http\Requests\StoreSuratKeluarRequest;
use App\Http\Requests\UpdateSuratKeluarRequest;
use Illuminate\Support\Facades\Storage;

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
        $divisi = [
            'Kk.21.11/1' => 'SEKJEN, KATOLIK',
            'Kk.21.11/2' => 'PENDIS',
            'Kk.21.11/3' => 'SEKSI PENY. HAJI & UMRAH',
            'Kk.21.11/4' => 'SEKSI BIMAS ISLAM',
            'Kk.21.11/5' => 'PENY. SYARIAH',
            'Kk.21.11/6' => 'PENY. KRISTEN',
            'Kk.21/11/1' => 'HINDU',
        ];

        return view('admin.surat_keluar.tambah_surat_keluar', compact('divisi'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratKeluarRequest $request)
    {
        $validatedData = $request->validated();

        // Cek apakah ada file yang diupload
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            //buat direktori jika belum ada
            $this->createDirectoryIfNotExists('public/surat-keluar');

            $file->store('public/surat-keluar');
            $validatedData['file'] = $file->hashName();
        }

        SuratKeluar::create($validatedData);

        return redirect()->route('suratKeluar.index')->with('success', 'Surat Keluar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeluar $suratKeluar) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        $divisi = [
            'Kk.21.11/1' => 'SEKJEN, KATOLIK',
            'Kk.21.11/2' => 'PENDIS',
            'Kk.21.11/3' => 'SEKSI PENY. HAJI & UMRAH',
            'Kk.21.11/4' => 'SEKSI BIMAS ISLAM',
            'Kk.21.11/5' => 'PENY. SYARIAH',
            'Kk.21.11/6' => 'PENY. KRISTEN',
            'Kk.21/11/1' => 'HINDU',
        ];
        return view('admin.surat_keluar.update_surat_keluar', compact('suratKeluar', 'divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratKeluarRequest $request, SuratKeluar $suratKeluar)
    {
        $validatedData = $request->validated();

        // Cek apakah ada file yang diupload
        $oldFile = $suratKeluar->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            //buat direktori jika belum ada
            $this->createDirectoryIfNotExists('public/surat-keluar');

            $file->store('public/surat-keluar');
            $validatedData['file'] = $file->hashName();

            $this->deleteOldFile($oldFile);
        }

        // Update surat keluar
        $suratKeluar->update($validatedData);

        return redirect()->route('suratKeluar.index')->with('success', 'Data Surat Keluar Telah Dihapus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        $this->deleteOldFile($suratKeluar->file);

        $suratKeluar->delete();

        return redirect()->route('suratKeluar.index')->with('success', 'Data Surat Keluar Telah Dihapus');
    }

    protected function createDirectoryIfNotExists($path)
    {
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
    }

    protected function deleteOldFile($oldFile)
    {
        if ($oldFile) {
            Storage::disk('public/surat-keluar')->delete($oldFile);
        }
    }
}
