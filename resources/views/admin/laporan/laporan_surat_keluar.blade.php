<div class="card-body">
    <!-- Form input Tanggal Mulai dan Tanggal Akhir -->
    <div class="d-flex justify-content-between">
        <form action="{{ route('export.suratKeluar') }}" method="GET" class="d-flex align-items-end mb-3">
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
