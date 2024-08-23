<div class="card-body">
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
                <th>File</th>
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
                    <td>
                        @if ($suratMasuk->file)
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#fileModal"
                                data-file="{{ asset('storage/surat-masuk/' . $suratMasuk->file) }}">
                                Lihat
                            </button>
                        @else
                            Tidak Ada File
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data Kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>

     <!--Tombol Cetak-->
     <a href="{{ route('export.suratMasuk') }}" class="btn btn-primary mb-2">Cetak</a>
</div>
