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
        // document.getElementById('searchInput').addEventListener('keyup', function() {
        //     let input = this.value.toLowerCase();
        //     let rows = document.querySelectorAll('#tableBody tr');

        //     rows.forEach(function(row) {
        //         let nomorSurat = row.cells[1].textContent.toLowerCase();
        //         let pengirim = row.cells[4].textContent.toLowerCase();
        //         let perihal = row.cells[5].textContent.toLowerCase();

        //         if (nomorSurat.includes(input) || pengirim.includes(input) || perihal.includes(input)) {
        //             row.style.display = '';
        //         } else {
        //             row.style.display = 'none';
        //         }
        //     });
        // });

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
