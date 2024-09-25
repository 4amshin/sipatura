<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Masuk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h3,
        p {
            text-align: center;
            /* Menyelaraskan teks ke tengah */
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 25%;
            /* Atur lebar sesuai kebutuhan */
            white-space: nowrap;
            /* Mencegah pemotongan ke baris baru */
        }
    </style>
</head>

<body>
    <h3>LAPORAN SURAT KELUAR KEMENTERIAN AGAMA<br>KABUPATEN LUWU UTARA</h3>
    <p>{{ \Carbon\Carbon::parse($request->start_date)->translatedFormat('d F Y') }} -
        {{ \Carbon\Carbon::parse($request->end_date)->translatedFormat('d F Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>DiKirim Tanggal</th>
                <th>Kepada</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarSuratKeluar as $index => $suratKeluar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $suratKeluar->nomor_surat }}</td>
                    <td>{{ \Carbon\Carbon::parse($suratKeluar->tanggal_surat)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($suratKeluar->tanggal_keluar)->format('d/m/Y') }}</td>
                    <td>{{ $suratKeluar->kepada }}</td>
                    <td>{{ $suratKeluar->perihal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
