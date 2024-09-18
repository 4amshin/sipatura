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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->date('tanggal_keluar');
            $table->enum('pengirim', ['SEKJEN', 'PENDIS', 'SEKSI PENY. HAJI & UMRAH', 'SEKSI BIMAS ISLAM', 'PENY. SYARIAH', 'PENY. KRISTEN', 'KATOLIK', 'HINDU', 'UMUM'])->default('UMUM');
            $table->string('kepada');
            $table->text('perihal');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
