<?php

namespace App\Http\Controllers;

use App\Exports\SuratKeluarExport;
use App\Exports\SuratMasukExport;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function exportSuratMasuk(Request $request)
    {
        // Validasi tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil data berdasarkan tanggal
        $daftarSuratMasuk = SuratMasuk::whereBetween('tanggal_masuk', [$request->start_date, $request->end_date])->get();

        // Jika tidak ada data
        if ($daftarSuratMasuk->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk periode tersebut.');
        }

        // Generate PDF menggunakan view
        $pdf = Pdf::loadView('exports.surat_masuk_pdf', compact('daftarSuratMasuk'));

        // Unduh file PDF
        return $pdf->download('laporan_surat_masuk_' . $request->start_date . '_to_' . $request->end_date . '.pdf');
    }
    public function exportSuratKeluar(Request $request)
    {
        // Validasi tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil data berdasarkan tanggal
        $daftarSuratKeluar = SuratKeluar::whereBetween('tanggal_keluar', [$request->start_date, $request->end_date])->get();

        // Jika tidak ada data
        if ($daftarSuratKeluar->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk periode tersebut.');
        }

        // Generate PDF menggunakan view
        $pdf = Pdf::loadView('exports.surat_keluar_pdf', compact('daftarSuratKeluar'));

        // Unduh file PDF
        return $pdf->download('laporan_surat_keluar_' . $request->start_date . '_to_' . $request->end_date . '.pdf');
    }

    public function getSuratMasuk(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $daftarSuratMasuk = SuratMasuk::whereBetween('tanggal_masuk', [$startDate, $endDate])->get();

        return response()->json($daftarSuratMasuk);
    }
    public function getSuratKeluar(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $daftarSuratKeluar = SuratKeluar::whereBetween('tanggal_keluar', [$startDate, $endDate])->get();

        return response()->json($daftarSuratKeluar);
    }
}
