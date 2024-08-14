@extends('layout.app')

@section('title', 'Surat Masuk')

@section('content')
    <!--Notifikasi-->
    @include('layout.page_alert')

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!--Tombol Tambah Surat Masuk-->
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                    data-bs-target="#tambahSuratMasukModal">
                    Tambah Surat Masuk
                </button>

                <!--Tabel-->
                <table class="table table-striped" id="table1">
                    <!--Head-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Diterima Tanggal</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                        </tr>
                    </thead>

                    <!--Body-->
                    <tbody>
                        @forelse ($daftarSuratMasuk as $suratMasuk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-light-info">
                                        {{ $suratMasuk->nomor_surat }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-light-primary">
                                        {{ \Carbon\Carbon::parse($suratMasuk->tanggal_masuk)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>{{ $suratMasuk->pengirim }}</td>
                                <td>{{ $suratMasuk->perihal }}</td>
                                @can('super-user')
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <!--Tombol Update-->
                                                <a href="{{ route('suratMasuk.edit', $suratMasuk->id) }}" class="dropdown-item">
                                                    <i class="bi bi-pen"></i> Edit
                                                </a>

                                                <!--Tombol Hapus-->
                                                <form action="{{ route('suratMasuk.destroy', $suratMasuk->id) }}"
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
    <!---Modal Tambah Surat Masuk-->
    @include('admin.surat_masuk.modal_tambah_surat_masuk')
@endsection
