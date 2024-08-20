@extends('layout.app_no_sidebar')

@section('title', 'Update Surat Keluar')

@section('header', 'Update Surat Keluar')

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('suratKeluar.update', $suratKeluar->id) }}" method="POST"
                    enctype="multipart/form-data">
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
                                    name="nomor_surat" value="{{ old('nomor_surat', $suratKeluar->nomor_surat) }}" required>
                            </div>

                            <!-- Tanggal Surat -->
                            <div class="col-md-4">
                                <label for="tanggal_surat">Tanggal Surat</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_surat" class="form-control" name="tanggal_surat"
                                    value="{{ old('tanggal_surat', $suratKeluar->tanggal_surat) }}" required>
                            </div>

                            <!-- Tanggal Keluar -->
                            <div class="col-md-4">
                                <label for="tanggal_keluar">Tanggal Keluar</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="tanggal_keluar" class="form-control" name="tanggal_keluar"
                                    value="{{ old('tanggal_keluar', $suratKeluar->tanggal_keluar) }}" required>
                            </div>

                            <!-- Kepada -->
                            <div class="col-md-4">
                                <label for="kepada">Kepada</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="kepada" class="form-control" name="kepada" placeholder="Nama atau Instansi Tujuan"
                                    value="{{ old('kepada', $suratKeluar->kepada) }}" required>
                            </div>

                            <!-- Perihal -->
                            <div class="col-md-4">
                                <label for="perihal">Perihal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <textarea id="perihal" class="form-control" placeholder="Isi Ringkasan" name="perihal" rows="4" required>{{ old('perihal', $suratKeluar->perihal) }}</textarea>
                            </div>

                            <!-- File -->
                            <div class="col-md-4">
                                <label for="file">File <small>(PDF, Maximal 2MB)</small></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <div class="d-flex align-items-center">
                                    <input type="file" id="file" class="form-control @error('file') is-invalid @enderror" name="file" accept=".pdf">
                                    @if ($suratKeluar->file)
                                        <button type="button" class="btn btn-info btn-sm ms-2" data-bs-toggle="modal"
                                            data-bs-target="#fileModal"
                                            data-file="{{ asset('storage/surat-keluar/' . $suratKeluar->file) }}">
                                            Lihat
                                        </button>
                                    @endif
                                </div>
                                @error('file')
                                    <div class="parsley-error filled" id="parsley-id-5" aria-hidden="false">
                                        <span class="parsley-required">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="button" class="btn btn-danger me-1 mb-1"
                                    onclick="window.history.back()">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan File PDF -->
    @include('layout.component.modal_lihat_surat', ['title' => 'File Surat Keluar'])
@endsection


@push('customJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fileModal = document.getElementById('fileModal');
            fileModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Tombol yang diklik
                var fileUrl = button.getAttribute('data-file'); // Ambil URL file dari data attribute

                // Set src dari iframe ke file yang sesuai
                var iframe = fileModal.querySelector('#pdfViewer');
                iframe.src = fileUrl;
            });

            fileModal.addEventListener('hidden.bs.modal', function() {
                // Reset src dari iframe saat modal ditutup
                var iframe = fileModal.querySelector('#pdfViewer');
                iframe.src = '';
            });
        });
    </script>
@endpush
