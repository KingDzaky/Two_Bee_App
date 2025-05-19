<!DOCTYPE html>
<html>
<head>
    <title>Data Orderan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h2>Data Semua Orderan</h2>

    <table>
        <thead>
            <tr>
                <th>No Nota</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Layanan</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderans as $orderan)
            <tr>
                <td>{{ $orderan->no_nota }}</td>
                <td>{{ $orderan->pelanggan->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($orderan->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $orderan->waktu }}</td>
                <td>{{ $orderan->layanan->nama_layanan }}</td>
                <td>Rp{{ number_format($orderan->harga, 0, ',', '.') }}</td>
                <td>{{ $orderan->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
