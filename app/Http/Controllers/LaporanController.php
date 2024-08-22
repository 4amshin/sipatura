<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $daftarSuratMasuk = SuratMasuk::all();
        $daftarSuratKeluar = SuratKeluar::all();

        $tabs = [
            [
                'id' => 'suratMasuk',
                'title' => 'Surat Masuk',
                'view' => 'admin.laporan.laporan_surat_masuk',
            ],
            [
                'id' => 'suratKeluar',
                'title' => 'Surat Keluar',
                'view' => 'admin.laporan.laporan_surat_keluar',
            ]
        ];

        return view('admin.laporan.laporan', compact('tabs', 'daftarSuratMasuk', 'daftarSuratKeluar'));
    }
}
