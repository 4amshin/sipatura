<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Http\Requests\StoreSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;
use Illuminate\Support\Facades\Storage;

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
        // Validasi data
        $validatedData = $request->validated();

        // Cek apakah ada file yang diupload
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            //buat direktori jika belum ada
            $this->createDirectoryIfNotExists('public/surat-masuk');

            $file->store('public/surat-masuk');
            $validatedData['file'] = $file->hashName();
        }

        // Simpan data ke database
        SuratMasuk::create($validatedData);

        // Redirect dengan pesan sukses
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

        // Cek apakah ada file yang diupload
        $oldFile = $suratMasuk->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            //buat direktori jika belum ada
            $this->createDirectoryIfNotExists('public/surat-masuk');

            $file->store('public/surat-masuk');
            $validatedData['file'] = $file->hashName();

            $this->deleteOldFile($oldFile);
        }

        $suratMasuk->update($validatedData);

        return redirect()->route('suratMasuk.index')->with('success', 'Data Surat Masuk DiPerbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        $this->deleteOldFile($suratMasuk->file);

        $suratMasuk->delete();

        return redirect()->route('suratMasuk.index')->with('success', 'Data Surat Masuk Telah Dihapus');
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
            Storage::disk('public/surat-masuk')->delete($oldFile);
        }
    }
}
