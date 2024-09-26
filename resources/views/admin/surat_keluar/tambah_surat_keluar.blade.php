@extends('layout.app_no_sidebar')

@section('title', 'Tambah Surat Keluar')

@section('header', 'Tambah Surat Keluar')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('suratKeluar.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <!-- Nomor Surat -->
                            <div class="col-md-4">
                                <label for="nomor_surat">Nomor Surat</label>
                            </div>
                            <div class="col-md-3 form-group">
                                <select id="divisi" class="form-select" onchange="generateNomorSurat()" required>
                                    <option value="" disabled selected>Pilih Divisi/Bidang</option>
                                    @foreach ($divisi as $kode => $nama)
                                        <option value="{{ $kode }}" data-kode="{{ explode('-', $kode)[0] }}"
                                            data-nama="{{ $nama }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 form-group">
                                <input type="text" id="nomor_surat" class="form-control" placeholder="Nomor Surat"
                                    name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                            </div>

                            <!-- Hidden Input untuk Pengirim -->
                            <input type="hidden" id="pengirim" name="pengirim" value="{{ old('pengirim') }}">

                            <!-- Tanggal Surat -->
                            <div class="col-md-4">
                                <label for="tanggal_surat">Tanggal Surat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_surat" class="form-control" name="tanggal_surat"
                                    value="{{ old('tanggal_surat') }}" required>
                            </div>

                            <!-- Dikirim Tanggal -->
                            <div class="col-md-4">
                                <label for="tanggal_keluar">Dikirim Tanggal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_keluar" class="form-control" name="tanggal_keluar"
                                    value="{{ old('tanggal_keluar') }}" required>
                            </div>

                            <!-- Kepada -->
                            <div class="col-md-4">
                                <label for="kepada">Kepada</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="kepada" class="form-control" name="kepada"
                                    value="{{ old('kepada') }}" placeholder="Nama atau Instansi Tujuan" required>
                            </div>

                            <!-- Perihal -->
                            <div class="col-md-4">
                                <label for="perihal">Perihal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="perihal" class="form-control" placeholder="Isi Ringkasan" name="perihal" rows="4" required>{{ old('perihal') }}</textarea>
                            </div>

                            <!-- File -->
                            <div class="col-md-4">
                                <label for="file">File <small>(PDF, Maximal 2MB)</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="file" id="file"
                                    class="form-control @error('file') is-invalid @enderror" name="file" accept=".pdf">
                                @error('file')
                                    <div class="parsley-error filled" id="parsley-id-5" aria-hidden="false">
                                        <span class="parsley-required">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                <button type="button" class="btn btn-danger me-1 mb-1"
                                    onclick="window.history.back()">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('customJs')
    <script>
        var nomorUrutBaru = '{{ $nomorUrutBaru }}'; // Ambil nomor urut baru dari server

        function generateNomorSurat() {
            var divisiSelect = document.getElementById('divisi');
            var divisiKode = divisiSelect.options[divisiSelect.selectedIndex].getAttribute('data-kode');
            var divisiNama = divisiSelect.options[divisiSelect.selectedIndex].getAttribute('data-nama');
            var nomorSurat = document.getElementById('nomor_surat');
            var pengirim = document.getElementById('pengirim');

            // Pastikan divisiKode dan divisiNama diambil dengan benar
            if (!divisiKode || !divisiNama) {
                nomorSurat.value = '';
                pengirim.value = '';
                return; // Jika tidak ada data divisi yang dipilih, kita hentikan proses
            }

            // Format dasar nomor surat
            var formatAwal = "B-"; // Prefix "B"

            // Tambahkan leading zero pada nomor urut agar selalu 4 digit
            var nomorUrutPadded = nomorUrutBaru.toString().padStart(4, '0');

            // Ambil tahun saat ini secara otomatis
            var currentYear = new Date().getFullYear();


            // Format akhir bisa disesuaikan
            var formatAkhir = "/xx.xx.x/xx/" + currentYear; // Ganti dengan format akhir yang diinginkan

            // Set value input nomor surat dengan format yang benar
            nomorSurat.value = formatAwal + nomorUrutPadded + "/" + divisiKode + formatAkhir;
            pengirim.value = divisiNama;
        }
    </script>
@endpush
