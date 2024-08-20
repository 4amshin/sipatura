@extends('layout.app_no_sidebar')

@section('title', 'Tambah Surat Masuk')

@section('header', 'Tambah Surat Masuk')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('suratMasuk.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <!-- Nomor Surat -->
                            <div class="col-md-4">
                                <label for="nomor_surat">Nomor Surat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nomor_surat" class="form-control" placeholder="Nomor Surat"
                                    name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                            </div>

                            <!-- Tanggal Surat -->
                            <div class="col-md-4">
                                <label for="tanggal_surat">Tanggal Surat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_surat" class="form-control" name="tanggal_surat"
                                    value="{{ old('tanggal_surat') }}" required>
                            </div>

                            <!-- Tanggal Masuk -->
                            <div class="col-md-4">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_masuk" class="form-control" name="tanggal_masuk"
                                    value="{{ 'tanggal_masuk' }}" required>
                            </div>

                            <!-- Pengirim -->
                            <div class="col-md-4">
                                <label for="pengirim">Pengirim</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="pengirim" class="form-control" name="pengirim"
                                    value="{{ old('pengirim') }}" placeholder="Nama atau Instansi Pengirim" required>
                            </div>

                            <!-- Perihal -->
                            <div class="col-md-4">
                                <label for="perihal">Perihal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="perihal" class="form-control" placeholder="Perihal Surat" name="perihal" rows="4" required>{{ old('perihal') }}</textarea>
                            </div>

                            <!-- File -->
                            <div class="col-md-4">
                                <label for="file">File <small>(PDF, Maximal 2MB)</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="file" id="file"
                                    class="form-control @error('file') is-invalid @enderror" name="file" accept=".pdf"
                                    required>
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
