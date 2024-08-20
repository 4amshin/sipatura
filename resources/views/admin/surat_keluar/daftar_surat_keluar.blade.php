@extends('layout.app')

@section('title', 'Surat Keluar')

@section('content')
    <!--Notifikasi-->
    @include('layout.page_alert')

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!--Tombol Tambah Surat Keluar-->
                <a href="{{ route('suratKeluar.create') }}" class="btn btn-primary mb-2">Tambah Surat Keluar</a>

                <!--Tabel-->
                <table class="table table-striped" id="table1">
                    <!--Head-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Dikirim Tanggal</th>
                            <th>Kepada</th>
                            <th>Perihal</th>
                            <th>File</th>
                        </tr>
                    </thead>

                    <!--Body-->
                    <tbody>
                        @forelse ($daftarSuratKeluar as $suratKeluar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-light-info">
                                        {{ $suratKeluar->nomor_surat }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($suratKeluar->tanggal_surat)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-light-primary">
                                        {{ \Carbon\Carbon::parse($suratKeluar->tanggal_Keluar)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>{{ $suratKeluar->kepada }}</td>
                                <td>{{ $suratKeluar->perihal }}</td>
                                <td>
                                    @if ($suratKeluar->file)
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#fileModal"
                                            data-file="{{ asset('storage/surat-keluar/' . $suratKeluar->file) }}">
                                            Lihat
                                        </button>
                                    @else
                                        Tidak Ada File
                                    @endif
                                </td>
                                @can('super-user')
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <!--Tombol Update-->
                                                <a href="{{ route('suratKeluar.edit', $suratKeluar->id) }}" class="dropdown-item">
                                                    <i class="bi bi-pen"></i> Edit
                                                </a>

                                                <!--Tombol Hapus-->
                                                <form action="{{ route('suratKeluar.destroy', $suratKeluar->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bi bi-trash3"></i> Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            Data Kosong
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal untuk Menampilkan File PDF -->
    @include('layout.component.modal_lihat_surat', ['title', 'File Surat Keluar'])
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
