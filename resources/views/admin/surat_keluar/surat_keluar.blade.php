@extends('layout.app')

@section('title', 'Surat Keluar')

@section('content')
    <!--Notifikasi-->
    @include('layout.page_alert')

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!--Tombol Tambah Surat Keluar-->
                <a href="{{ route('suratMasuk.create') }}" class="btn btn-primary mb-2">Tambah Surat Keluar</a>

                <!--Tabel-->
                <table class="table table-striped" id="table1">
                    <!--Head-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Keluar</th>
                            <th>Isi Ringkasan</th>
                            <th>Keterangan</th>
                            <th>Lokasi File</th>
                            <th>Alamat</th>
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
                                <td>{{ $suratKeluar->tanggal_keluar }}</td>
                                <td>{{ $suratKeluar->isi_ringkasan }}</td>
                                <td>{{ $suratKeluar->keterangan }}</td>
                                <td>{{ $suratKeluar->lokasi_file }}</td>
                                <td>{{ $suratKeluar->alamat }}</td>
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
@endsection
