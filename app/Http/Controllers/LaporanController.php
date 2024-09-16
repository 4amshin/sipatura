<?php

namespace App\Http\Controllers;

use App\Exports\SuratKeluarExport;
use App\Exports\SuratMasukExport;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $daftarSuratMasuk = SuratMasuk::orderBy('tanggal_masuk', 'desc')->get();
        $daftarSuratKeluar = SuratKeluar::orderBy('tanggal_keluar', 'desc')->get();

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

    public function exportSuratMasuk(Request $request)
    {
        $namaFile = 'surat_masuk_' . Carbon::now()->format('d-m-y') . '.xlsx';
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new SuratMasukExport($startDate, $endDate), $namaFile);
    }

    public function exportSuratKeluar(Request $request)
    {
        $namaFile = 'surat_keluar_' . Carbon::now()->format('d-m-y') . '.xlsx';
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new SuratKeluarExport($startDate, $endDate), $namaFile);
    }
}
