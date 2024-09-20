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
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Surat Masuk</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Masuk</th>
                <th>Pengirim</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarSuratMasuk as $index => $suratMasuk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $suratMasuk->nomor_surat }}</td>
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
