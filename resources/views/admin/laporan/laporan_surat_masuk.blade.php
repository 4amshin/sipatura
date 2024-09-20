{{-- <div class="card-body">
    <!-- Form input Tanggal Mulai dan Tanggal Akhir -->
    <div class="d-flex justify-content-between">
        <form action="{{ route('export.suratMasuk') }}" method="GET" class="d-flex align-items-end mb-3">
            <div class="me-3">
                <label for="startDate" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="startDate" name="start_date" required>
            </div>
            <div class="me-3">
                <label for="endDate" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="endDate" name="end_date" required>
            </div>
            <!-- Tombol Cetak -->
            <div class="align-self-end">
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
        </form>

         <!-- Input Live Search -->
         <div class="align-self-end">
            <input type="text" id="searchInputMasuk" class="form-control" placeholder="Cari Surat Masuk...">
        </div>
    </div>

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
        <tbody id="tableBodyMasuk">
            @forelse ($daftarSuratMasuk as $index => $suratMasuk)
                <tr>
                    <td>{{ $index + $daftarSuratMasuk->firstItem() }}</td>
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

    <!--Navigasi Halaman-->
    <nav class="p-3" aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            {{ $daftarSuratMasuk->withQueryString()->links() }}
        </ul>
    </nav>
</div> --}}




<div class="card-body">
    <!-- Form input Tanggal Mulai dan Tanggal Akhir -->
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-end mb-3">
            <div class="me-3">
                <label for="startDate" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="startDate" name="start_date" required>
            </div>
            <div class="me-3">
                <label for="endDate" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="endDate" name="end_date" required>
            </div>
            <!-- Tombol Cetak -->
            <div class="align-self-end">
                <button type="button" class="btn btn-primary" id="btnCetak">Cetak</button>
            </div>
        </div>

        <!-- Input Live Search -->
        <div class="align-self-end">
            <input type="text" id="searchInputMasuk" class="form-control" placeholder="Cari Surat Masuk...">
        </div>
    </div>

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
        <tbody id="tableBodyMasuk">
            @forelse ($daftarSuratMasuk as $index => $suratMasuk)
                <tr>
                    <td>{{ $index + $daftarSuratMasuk->firstItem() }}</td>
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

    <!--Navigasi Halaman-->
    <nav class="p-3" aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            {{ $daftarSuratMasuk->withQueryString()->links() }}
        </ul>
    </nav>
</div>

<!-- Modal untuk menampilkan data -->
<div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="cetakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakModalLabel">Data Surat Berdasarkan Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="tableCetak">
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
                    <tbody id="cetakTableBody">
                        <!-- Data akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnDownload">Download PDF</button>
            </div>
        </div>
    </div>
</div>

