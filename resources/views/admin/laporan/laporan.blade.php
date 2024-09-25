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
        // Fungsi umum untuk menampilkan data dalam modal dan memproses filter tanggal
        function fetchAndShowData(modalId, tableBodyId, url, startDate, endDate, tanggalCetakId = null) {
            if (startDate && endDate) {
                fetch(`${url}?start_date=${startDate}&end_date=${endDate}`)
                    .then(response => response.json())
                    .then(data => {
                        let tableBody = document.getElementById(tableBodyId);
                        tableBody.innerHTML = '';

                        data.forEach((surat, index) => {
                            let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td class="text-nowrap" style="width: 200px;">${surat.nomor_surat}</td>
                                <td>${new Date(surat.tanggal_surat).toLocaleDateString()}</td>
                                <td>${surat.tanggal_masuk ? new Date(surat.tanggal_masuk).toLocaleDateString() : new Date(surat.tanggal_keluar).toLocaleDateString()}</td>
                                <td>${surat.pengirim || surat.penerima}</td>
                                <td>${surat.perihal}</td>
                            </tr>
                        `;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });

                        // Menampilkan tanggal di bawah judul jika elemen ID untuk tanggal disediakan
                        if (tanggalCetakId) {
                            let startDateFormatted = formatTanggal(new Date(startDate));
                            let endDateFormatted = formatTanggal(new Date(endDate));
                            document.getElementById(tanggalCetakId).textContent =
                                `${startDateFormatted} - ${endDateFormatted}`;
                        }

                        let modal = new bootstrap.Modal(document.getElementById(modalId));
                        modal.show();
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Silakan pilih tanggal mulai dan tanggal akhir.');
            }
        }

        // Fungsi untuk format tanggal menjadi "01/Agustus/2001"
        function formatTanggal(date) {
            const options = {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            const formattedDate = date.toLocaleDateString('id-ID', options);

            // Mengganti nama bulan dari lowercase menjadi capitalize (huruf pertama kapital)
            return formattedDate.replace(/\b\w/g, function(l) {
                return l.toUpperCase()
            });
        }

        // Fungsi umum untuk mendownload PDF
        function downloadPDF(url, startDate, endDate) {
            if (startDate && endDate) {
                window.location.href = `${url}/export?start_date=${startDate}&end_date=${endDate}`;
            } else {
                alert('Silakan pilih tanggal mulai dan tanggal akhir.');
            }
        }

        // Fungsi search umum
        function setupSearch(inputId, tableBodyId) {
            document.getElementById(inputId).addEventListener('keyup', function() {
                let input = this.value.toLowerCase();
                let rows = document.querySelectorAll(`#${tableBodyId} tr`);

                rows.forEach(function(row) {
                    let nomorSurat = row.cells[1].textContent.toLowerCase();
                    let pihakTerkait = row.cells[4].textContent.toLowerCase();
                    let perihal = row.cells[5].textContent.toLowerCase();

                    if (nomorSurat.includes(input) || pihakTerkait.includes(input) || perihal.includes(
                            input)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Fungsi umum untuk membuka halaman PDF dan langsung mencetaknya
        function printPDF(btnId, urlBase, startDateId, endDateId) {
            document.getElementById(btnId).addEventListener('click', function() {
                let startDate = document.getElementById(startDateId).value;
                let endDate = document.getElementById(endDateId).value;

                if (startDate && endDate) {
                    // Membuka halaman PDF dalam jendela baru dengan parameter start_date dan end_date
                    let url = `${urlBase}?start_date=${startDate}&end_date=${endDate}`;
                    let printWindow = window.open(url, '_blank');
                    printWindow.onload = function() {
                        printWindow.print();
                    };
                } else {
                    alert('Silakan pilih tanggal mulai dan tanggal akhir.');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Pengaturan untuk tombol print Surat Masuk dan Surat Keluar
            printPDF('btnPrintMasuk', '{{ route("surat_masuk_pdf") }}', 'startDateMasuk', 'endDateMasuk');
            printPDF('btnPrintKeluar', '{{ route("surat_keluar_pdf") }}', 'startDateKeluar', 'endDateKeluar');

            // Event Listener untuk Surat Masuk
            document.getElementById('btnCetakMasuk').addEventListener('click', function() {
                let startDate = document.getElementById('startDateMasuk').value;
                let endDate = document.getElementById('endDateMasuk').value;
                fetchAndShowData('cetakModalMasuk', 'cetakTableBodyMasuk', '/laporan/surat-masuk',
                    startDate, endDate, 'tanggalCetakMasuk');
            });

            document.getElementById('btnDownloadMasuk').addEventListener('click', function() {
                let startDate = document.getElementById('startDateMasuk').value;
                let endDate = document.getElementById('endDateMasuk').value;
                downloadPDF('/laporan/surat-masuk', startDate, endDate);
            });

            // Event Listener untuk Surat Keluar
            document.getElementById('btnCetakKeluar').addEventListener('click', function() {
                let startDate = document.getElementById('startDateKeluar').value;
                let endDate = document.getElementById('endDateKeluar').value;
                fetchAndShowData('cetakModalKeluar', 'cetakTableBodyKeluar', '/laporan/surat-keluar',
                    startDate, endDate, 'tanggalCetakKeluar');
            });

            document.getElementById('btnDownloadKeluar').addEventListener('click', function() {
                let startDate = document.getElementById('startDateKeluar').value;
                let endDate = document.getElementById('endDateKeluar').value;
                downloadPDF('/laporan/surat-keluar', startDate, endDate);
            });

            // Setup Search untuk Surat Masuk dan Keluar
            setupSearch('searchInputMasuk', 'tableBodyMasuk');
            setupSearch('searchInputKeluar', 'tableBodyKeluar');
        });
    </script>
@endpush
