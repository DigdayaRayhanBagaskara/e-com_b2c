<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 40px;
            font-size: 14px;
        }

        h4, h5 {
            text-align: center;
            margin: 0;
        }

        .line {
            border-bottom: 3px solid black;
            margin: 10px 0 20px 0;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 20px;
        }

        thead {
            background-color: #343a40;
            color: white;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        .signature {
            width: 300px;
            float: right;
            text-align: center;
            margin-top: 80px;
        }

        @media print {
            body {
                padding: 0;
            }

            .signature {
                margin-top: 100px;
            }
        }
    </style>
</head>

<body>
    <h4>Kantin Athaya Dang Merdu</h4>
    <h5 class="line">Laporan Transaksi</h5>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pesanan</th>
                <th>Nama Pemesan</th>
                <th>No. Telp</th>
                <th>Nama Penerima</th>
                <th>Lokasi Antar</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_pesanan)->format('d M Y | H:i:s') }}</td>
                <td>{{ $row->users->username }}</td>
                <td>{{ $row->users->no_hp }}</td>
                <td>{{ $row->nama_penerima }}</td>
                <td>{{ $row->lokasi_antar }}</td>
                <td>{{ 'Rp ' . number_format($row->total_bayar) }}</td>
                <td>{{ $row->status_pesanan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        Pekanbaru, {{ \Carbon\Carbon::parse($date)->format('d M Y') }}<br>
        Pimpinan Kantin Athaya Dang Merdu,<br><br><br><br>
        <strong><u>{{ $pimpinan }}</u></strong>
    </div>
</body>

</html>
