<div class="card-body">
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
                </tr>
            @empty
                Data Kosong
            @endforelse
        </tbody>
    </table>

    <!--Tombol Cetak-->
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#suratKeluarModal">
        Cetak
    </button>

    <!-- Modal (Vertically Centered) -->
    <div class="modal fade" id="suratKeluarModal" tabindex="-1" aria-labelledby="suratKeluarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratKeluarModalLabel">Cetak Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="exportForm" action="{{ route('export.suratKeluar') }}" method="GET">
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
