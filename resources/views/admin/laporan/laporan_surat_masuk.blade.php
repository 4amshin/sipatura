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
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exportModal">
        Cetak
    </button>

    <!-- Modal (Vertically Centered) -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Cetak Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="exportForm" action="{{ route('export.suratMasuk') }}" method="GET">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="endDate" name="end_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

