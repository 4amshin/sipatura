@extends('layout.app')

@section('title', 'Laporan')


@section('content')
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!--Tab Navigasi-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($tabs as $index => $tab)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="{{ $tab['id'] }}-tab"
                                        data-bs-toggle="tab" href="#{{ $tab['id'] }}" role="tab"
                                        aria-controls="{{ $tab['id'] }}"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ $tab['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!--Body Menu Tab-->
                        <div class="tab-content" id="myTabContent">
                            @foreach ($tabs as $index => $tab)
                                <div class="tab-pane fade {{ $index === 0 ? 'active show' : '' }}" id="{{ $tab['id'] }}"
                                    role="tabpanel" aria-labelledby="{{ $tab['id'] }}-tab">
                                    @include($tab['view'])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('customJs')
    <script>
        document.getElementById('btnCetak').addEventListener('click', function() {
            let startDate = document.getElementById('startDate').value;
            let endDate = document.getElementById('endDate').value;

            if (startDate && endDate) {
                // AJAX untuk mengambil data berdasarkan startDate dan endDate
                fetch(`/laporan/surat-masuk?start_date=${startDate}&end_date=${endDate}`)
                    .then(response => response.json())
                    .then(data => {
                        // Kosongkan tabel sebelumnya
                        let tableBody = document.getElementById('cetakTableBody');
                        tableBody.innerHTML = '';

                        // Tambahkan data ke tabel
                        data.forEach((surat, index) => {
                            let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${surat.nomor_surat}</td>
                            <td>${new Date(surat.tanggal_surat).toLocaleDateString()}</td>
                            <td>${new Date(surat.tanggal_masuk).toLocaleDateString()}</td>
                            <td>${surat.pengirim}</td>
                            <td>${surat.perihal}</td>
                            <td>${surat.file ? '<a href="' + surat.file_url + '" target="_blank">Lihat</a>' : 'Tidak Ada File'}</td>
                        </tr>
                    `;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });

                        // Tampilkan modal setelah data diisi
                        let modal = new bootstrap.Modal(document.getElementById('cetakModal'));
                        modal.show();
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Silakan pilih tanggal mulai dan tanggal akhir.');
            }
        });

        // Tombol untuk mendownload PDF
        document.getElementById('btnDownload').addEventListener('click', function() {
            let startDate = document.getElementById('startDate').value;
            let endDate = document.getElementById('endDate').value;

            // Arahkan pengguna ke URL download PDF berdasarkan tanggal
            window.location.href = `/laporan/surat-masuk/export?start_date=${startDate}&end_date=${endDate}`;
        });

        document.addEventListener('DOMContentLoaded', function() {
            function setupSearch(inputId, tableBodyId) {
                document.getElementById(inputId).addEventListener('keyup', function() {
                    let input = this.value.toLowerCase();
                    let rows = document.querySelectorAll(`#${tableBodyId} tr`);

                    rows.forEach(function(row) {
                        let nomorSurat = row.cells[1].textContent.toLowerCase();
                        let pengirim = row.cells[4].textContent.toLowerCase();
                        let perihal = row.cells[5].textContent.toLowerCase();

                        if (nomorSurat.includes(input) || pengirim.includes(input) || perihal
                            .includes(input)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            setupSearch('searchInputMasuk', 'tableBodyMasuk');
            setupSearch('searchInputKeluar', 'tableBodyKeluar');
        });
    </script>
@endpush
