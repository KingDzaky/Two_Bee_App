<!DOCTYPE html>
<html>
<head>
    <title>Chart PDF</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        img { width: 100%; max-width: 600px; }
    </style>
</head>
<body>
    <h2>Grafik Orderan</h2>
    @if($chartImage)
        <img src="{{ $chartImage }}" alt="Chart Image">
    @else
        <p>Tidak ada data chart.</p>
    @endif
</body>
</html>
