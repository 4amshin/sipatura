<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'tanggal_masuk',
        'isi_ringkasan',
        'keterangan',
        'lokasi_file',
        'alamat',
    ];
}
