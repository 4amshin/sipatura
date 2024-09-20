<?php

namespace App\Http\Controllers;

use App\Exports\SuratKeluarExport;
use App\Exports\SuratMasukExport;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $daftarSuratMasuk = SuratMasuk::orderBy('tanggal_masuk', 'desc')->paginate(5);
        $daftarSuratKeluar = SuratKeluar::orderBy('tanggal_keluar', 'desc')->paginate(5);

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

    // public function exportSuratMasuk(Request $request)
    // {
    //     $namaFile = 'surat_masuk_' . Carbon::now()->format('d-m-y') . '.xlsx';
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     return Excel::download(new SuratMasukExport($startDate, $endDate), $namaFile);
    // }

    // public function exportSuratKeluar(Request $request)
    // {
    //     $namaFile = 'surat_keluar_' . Carbon::now()->format('d-m-y') . '.xlsx';
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     return Excel::download(new SuratKeluarExport($startDate, $endDate), $namaFile);
    // }

    public function previewSuratMasuk(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $daftarSuratMasuk = SuratMasuk::whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        // Buat instance dari PDF
        $pdf = app(PDF::class); // Menggunakan metode `app()` untuk mendapatkan instance PDF
        $pdf->loadView('exports.surat_masuk_pdf', compact('daftarSuratMasuk'));
        $pdfContent = $pdf->output();

        return view('preview_surat_masuk', compact('pdfContent'));
    }

    public function exportPdfSuratMasuk(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $daftarSuratMasuk = SuratMasuk::whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        // Buat instance dari PDF
        $pdf = app(PDF::class); // Menggunakan metode `app()` untuk mendapatkan instance PDF
        $pdf->loadView('exports.surat_masuk_pdf', compact('daftarSuratMasuk'));
        $namaFile = 'surat_masuk_' . Carbon::now()->format('d-m-y') . '.pdf';

        return $pdf->download($namaFile);
    }

    public function getSuratMasuk(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $daftarSuratMasuk = SuratMasuk::whereBetween('tanggal_masuk', [$startDate, $endDate])->get();

        return response()->json($daftarSuratMasuk);
    }
}
