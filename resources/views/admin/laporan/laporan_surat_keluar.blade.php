<div class="card-body">
    <!-- Form input Tanggal Mulai dan Tanggal Akhir -->
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-end mb-3">
            <div class="me-3">
                <label for="startDateKeluar" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="startDateKeluar" name="start_date_keluar" required>
            </div>
            <div class="me-3">
                <label for="endDateKeluar" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="endDateKeluar" name="end_date_keluar" required>
            </div>
            <!-- Tombol Cetak -->
            <div class="align-self-end">
                <button type="button" class="btn btn-primary" id="btnCetakKeluar">Cetak</button>
            </div>
        </div>

        <!-- Input Live Search -->
        <div class="align-self-end">
            <input type="text" id="searchInputKeluar" class="form-control" placeholder="Cari Surat Keluar...">
        </div>
    </div>

    <!--Tabel-->
    <table class="table table-striped" id="table2">
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
        <tbody id="tableBodyKeluar">
            @forelse ($daftarSuratKeluar as $index => $suratKeluar)
                <tr>
                    <td>{{ $index + $daftarSuratKeluar->firstItem() }}</td>
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

    <!--Navigasi Halaman-->
    <nav class="p-3" aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            {{ $daftarSuratKeluar->withQueryString()->links() }}
        </ul>
    </nav>
</div>

<!-- Modal untuk menampilkan data -->
<div class="modal fade" id="cetakModalKeluar" tabindex="-1" aria-labelledby="cetakModalKeluarLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakModalKeluarLabel">Data Surat Berdasarkan Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="tableCetakKeluar">
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
                    <tbody id="cetakTableBodyKeluar">
                        <!-- Data akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnDownloadKeluar">Download PDF</button>
            </div>
        </div>
    </div>
</div>
