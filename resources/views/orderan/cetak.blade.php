<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $orderan->no_nota }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; position: relative; }
        h2 { text-align: center; }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature p {
            margin-bottom: 80px;
        }
        .watermark {
            position: fixed;
            top: 30%;
            left: 20%;
            width: 60%;
            opacity: 0.05;
            text-align: center;
            font-size: 80px;
            transform: rotate(-30deg);
            z-index: -1;
        }
    </style>
</head>
<body>

    <!-- Watermark -->
    <div class="watermark">
        TwoBeeShoes
    </div>

    <!-- Logo -->
    <div class="header">
        <img src="{{ public_path('images/logo-sepatu.jpg') }}" alt="Logo">
        <h2>INVOICE ORDERAN</h2>
    </div>

    <p><strong>Nama:</strong> {{ $orderan->pelanggan->nama ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $orderan->pelanggan->alamat ?? '-' }}</p>
    <p><strong>Telepon:</strong> {{ $orderan->pelanggan->telepon ?? '-' }}</p>
    @if($orderan->pelanggan && $orderan->pelanggan->email)
        <p><strong>Email:</strong> {{ $orderan->pelanggan->email }}</p>
    @endif


    <p><strong>Tanggal Order:</strong> {{ \Carbon\Carbon::parse($orderan->tanggal)->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $orderan->layanan->nama_layanan }}</td>
                <td>Rp {{ number_format($orderan->harga, 0, ',', '.') }}</td>
                <td>{{ $orderan->status }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Keterangan Pembayaran:</h3>
    <p>
        @if($orderan->bukti_transfer)
            <strong style="color: green;">Sudah Bayar</strong>
        @else
            <strong style="color: red;">Belum Bayar</strong>
        @endif
    </p>


    <div class="signature">
        <p>Hormat Kami,</p>
        <strong>Admin TwoBeeShoes</strong>
    </div>

    <p style="text-align: right;">Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>

</body>
</html>
