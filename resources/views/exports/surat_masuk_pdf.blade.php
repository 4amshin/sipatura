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

        .nomor-surat {
            font-size: 0.9em;
            /* Mengubah ukuran font kolom Nomor Surat menjadi lebih kecil */
        }
    </style>
</head>

<body>
    <h3>LAPORAN SURAT MASUK KEMENTERIAN AGAMA<br>KABUPATEN LUWU UTARA</h3>
    <p>{{ \Carbon\Carbon::parse($request->start_date)->translatedFormat('d F Y') }} -
        {{ \Carbon\Carbon::parse($request->end_date)->translatedFormat('d F Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Diterima Tanggal</th>
                <th>Pengirim</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarSuratMasuk as $index => $suratMasuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="nomor-surat">{{ $suratMasuk->nomor_surat }}</td>
                    <td>{{ \Carbon\Carbon::parse($suratMasuk->tanggal_surat)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($suratMasuk->tanggal_masuk)->format('d/m/Y') }}</td>
                    <td>{{ $suratMasuk->pengirim }}</td>
                    <td>{{ $suratMasuk->perihal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
