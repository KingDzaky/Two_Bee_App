@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>


    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Jumlah Pelanggan</h2>
            <p class="text-3xl">{{ $jumlahPelanggan }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Order</h2>
            <p class="text-3xl">{{ $jumlahOrder }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Pendapatan</h2>
            <p class="text-3xl">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
    </div>


    {{-- Tambahan Status Order --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 text-blue-800 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Order Diproses</h2>
            <p class="text-3xl">{{ $orderProses }}</p>
        </div>
        <div class="bg-green-100 text-green-800 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Order Selesai</h2>
            <p class="text-3xl">{{ $orderSelesai }}</p>
        </div>
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Order Diantar</h2>
            <p class="text-3xl">{{ $orderDiantar }}</p>
        </div>
    </div>




    <div class="bg-white p-6 rounded shadow">
        <canvas id="orderChart" height="100"></canvas>

    </div>

    <div class="mt-3">
    <form id="exportChartForm" method="POST" action="{{ route('dashboard.exportPdf') }}">
        @csrf
        <input type="hidden" name="chartImage" id="chartImageInput">
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Export PDF Chart
        </button>
    </form>
</div>


    <div class="bg-white p-6 rounded shadow mt-6">
        <h2 class="text-lg font-semibold mb-2">Layanan Paling Sering Digunakan</h2>
        <canvas id="layananChart" height="100"></canvas>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('exportChartForm');
        const chartImageInput = document.getElementById('chartImageInput');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const canvas = document.getElementById('orderChart'); // ✅ ID SUDAH SAMA
            if (!canvas) {
                alert('Chart tidak ditemukan');
                return;
            }

            const dataURL = canvas.toDataURL('image/png');
            chartImageInput.value = dataURL;

            setTimeout(() => {
                form.submit();
            }, 100);
        });
    });
</script>





<script>
    const ctx = document.getElementById('orderChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($orderanChart->pluck('tanggal')) !!},
            datasets: [
                {
                    label: 'Total Order',
                    data: {!! json_encode($orderanChart->pluck('total_order')) !!},
                    borderColor: 'blue',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Total Pendapatan',
                    data: {!! json_encode($orderanChart->pluck('total_pendapatan')) !!},
                    borderColor: 'green',
                    fill: false,
                    tension: 0.3
                }
            ]
        },
    });
</script>

<script>
    const layananCtx = document.getElementById('layananChart').getContext('2d');
    const layananChart = new Chart(layananCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($layananFavorit->pluck('nama_layanan')) !!},
            datasets: [{
                label: 'Jumlah Order',
                data: {!! json_encode($layananFavorit->pluck('jumlah')) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>






@endsection
