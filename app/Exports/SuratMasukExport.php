<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratMasukExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $starDate;
    protected $endData;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($starDate, $endData)
    {
        $this->starDate = $starDate;
        $this->endData = $endData;
    }

    public function title(): string
    {
        return 'Surat Masuk';
    }

    public function collection()
    {
        $nomorUrut = 1;
        $daftarSuratMasuk = SuratMasuk::whereBetween('tanggal_masuk', [$this->starDate, $this->endData])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        return $daftarSuratMasuk->map(function ($suratMasuk) use (&$nomorUrut) {
            return [
                'No' => $nomorUrut++,
                'Nomor Surat' => $suratMasuk->nomor_surat,
                'Tanggal Surat' => \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->format('d/m/Y'),
                'Tanggal Masuk' => \Carbon\Carbon::parse($suratMasuk->tanggal_masuk)->format('d/m/Y') ,
                'Pengirim' => $suratMasuk->pengirim,
                'Perihal' => $suratMasuk->perihal,
                'File' => $suratMasuk->file ? url('storage/surat-masuk/' . $suratMasuk->file) : '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Surat',
            'Tanggal Surat',
            'Tanggal Masuk',
            'Pengirim',
            'Perihal',
            'File',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $daftarColumn = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $rataTengah = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]
        ];

        $styles = [];
        foreach ($daftarColumn as $column) {
            $styles[$column] = $rataTengah;
        }

        return $styles;
    }

    public function columnWidths(): array
    {
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
