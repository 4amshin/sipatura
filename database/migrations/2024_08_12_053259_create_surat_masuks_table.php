<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique(); // Nomor Surat
            $table->date('tanggal_masuk'); // Tanggal Masuk
            $table->text('isi_ringkasan'); // Isi Ringkasan
            $table->text('keterangan')->nullable(); // Keterangan, nullable
            $table->string('lokasi_file')->nullable(); // Lokasi File, nullable
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
