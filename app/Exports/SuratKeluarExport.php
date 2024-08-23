<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratKeluarExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function title(): string
    {
        return 'Surat Keluar';
    }

    public function collection()
    {
        $nomorUrut = 1;
        $daftarSuratKeluar = SuratKeluar::all();

        return $daftarSuratKeluar->map(function ($suratKeluar) use (&$nomorUrut) {
            return [
                'No' => $nomorUrut++,
                'Nomor Surat' => $suratKeluar->nomor_surat,
                'Tanggal Surat' => $suratKeluar->tanggal_surat,
                'Tanggal Keluar' => $suratKeluar->tanggal_keluar,
                'Kepada' => $suratKeluar->kepada,
                'Perihal' => $suratKeluar->perihal,
                'File' => $suratKeluar->file ? url('storage/surat-keluar/' . $suratKeluar->file) : '',
            ];
        });
    }

    public function headings(): array {
        return [
            'No',
            'Nomor Surat',
            'Tanggal Surat',
            'Tanggal Keluar',
            'Kepada',
            'Perihal',
            'File',
        ];
    }

    public function styles(Worksheet $sheet) {
        $daftarColumn = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $rataTengah = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]
        ];

        $styles = [];
        foreach($daftarColumn as $column) {
            $styles[$column] = $rataTengah;
        }

        return $styles;
    }

    public function columnWidths(): array {
        return [
            'A' => 3,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 35,
            'G' => 30,
        ];
    }
}
