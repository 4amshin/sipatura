@extends('layout.app')

@section('title', 'Update Surat Keluar')

@section('header', 'Update Surat Keluar')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('suratKeluar.update', $suratKeluar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <!-- Nomor Surat -->
                            <div class="col-md-4">
                                <label for="nomor_surat">Nomor Surat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nomor_surat" class="form-control" placeholder="Nomor Surat"
                                    name="nomor_surat" value="{{ $suratKeluar->nomor_surat }}" required>
                            </div>

                            <!-- Tanggal Keluar -->
                            <div class="col-md-4">
                                <label for="tanggal_keluar">Tanggal Keluar</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_keluar" class="form-control" name="tanggal_keluar"
                                    value="{{ $suratKeluar->tanggal_keluar }}" required>
                            </div>

                            <!-- Isi Ringkasan -->
                            <div class="col-md-4">
                                <label for="isi_ringkasan">Isi Ringkasan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="isi_ringkasan" class="form-control" placeholder="Isi Ringkasan" name="isi_ringkasan" rows="4"
                                    required>{{ $suratKeluar->isi_ringkasan }}</textarea>
                            </div>

                            <!-- Keterangan -->
                            <div class="col-md-4">
                                <label for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="keterangan" class="form-control" placeholder="Keterangan (Opsional)" name="keterangan" rows="3">{{ $suratKeluar->keterangan }}</textarea>
                            </div>

                            <!-- Lokasi File -->
                            <div class="col-md-4">
                                <label for="lokasi_file">Lokasi File</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="lokasi_file" class="form-control"
                                    placeholder="Lokasi File (Opsional)" name="lokasi_file"
                                    value="{{ $suratKeluar->lokasi_file }}">
                            </div>

                            <!-- Alamat -->
                            <div class="col-md-4">
                                <label for="alamat">Alamat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="alamat" class="form-control" placeholder="Alamat" name="alamat" rows="3" required>{{ $suratKeluar->alamat }}</textarea>
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
