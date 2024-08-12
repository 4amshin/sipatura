@extends('layout.app')

@section('title', 'Surat Masuk')

@section('content')
    <!--Notifikasi-->
    @include('layout.page-alert')

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!--Tombol Tambah Surat Masuk-->
                <a href="{{ route('suratMasuk.create') }}" class="btn btn-primary mb-2">Tambah Surat Masuk</a>

                <!--Tabel-->
                <table class="table table-striped" id="table1">
                    <!--Head-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Masuk</th>
                            <th>Isi Ringkasan</th>
                            <th>Keterangan</th>
                            <th>Lokasi File</th>
                            <th>Alamat</th>
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
                                <td>{{ $suratMasuk->tanggal_masuk }}</td>
                                <td>{{ $suratMasuk->isi_ringkasan }}</td>
                                <td>{{ $suratMasuk->keterangan }}</td>
                                <td>{{ $suratMasuk->lokasi_file }}</td>
                                <td>{{ $suratMasuk->alamat }}</td>
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
@endsection
