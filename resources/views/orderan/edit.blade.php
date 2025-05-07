@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Orderan</h1>

    <form action="{{ route('orderan.update', $orderan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Pelanggan --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Pelanggan</label>
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" value="{{ $orderan->pelanggan->nama }}" readonly>
            <input type="hidden" name="pelanggan_id" value="{{ $orderan->pelanggan_id }}">
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="block font-medium mb-1">Alamat</label>
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" value="{{ $orderan->alamat }}" readonly>
        </div>

        {{-- Telepon --}}
        <div class="mb-3">
            <label class="block font-medium mb-1">Telepon</label>
            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" value="{{ $orderan->telepon }}" readonly>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label class="block font-medium mb-1">Email</label>
            <input type="email" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100" value="{{ $orderan->email }}" readonly>
        </div>

        {{-- Tanggal dan Waktu --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $orderan->tanggal->format('Y-m-d') }}" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-medium">Waktu</label>
                <input type="time" name="waktu" value="{{ $orderan->waktu }}" class="w-full border p-2 rounded" required>
            </div>
        </div>

        {{-- Layanan dan Harga --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Tipe Layanan</label>
                <select name="layanan_id" id="layananSelect" class="border rounded p-2 w-full" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id }}"
                            data-harga="{{ $layanan->harga }}"
                            @if($layanan->id == $orderan->layanan_id) selected @endif>
                            {{ $layanan->id }} - {{ $layanan->nama_layanan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium">Harga</label>
                <input type="text" id="hargaInputFormat" class="w-full border p-2 rounded bg-gray-100" readonly>
                <input type="hidden" id="hargaInput" name="harga">
            </div>
        </div>

        {{-- No Nota --}}
        <div>
            <label class="block font-medium">No Nota</label>
            <input type="text" name="no_nota" value="{{ $orderan->no_nota }}" class="w-full border p-2 rounded" required>
        </div>

        {{-- Status --}}
        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded" required>
                <option value="Proses" @if($orderan->status == 'Proses') selected @endif>Proses</option>
                <option value="Selesai" @if($orderan->status == 'Selesai') selected @endif>Selesai</option>
                <option value="Diantar" @if($orderan->status == 'Diantar') selected @endif>Diantar</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update Orderan
        </button>
    </form>

    {{-- Script Format Harga --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const layananSelect = document.getElementById('layananSelect');
            const hargaInputFormat = document.getElementById('hargaInputFormat');
            const hargaInput = document.getElementById('hargaInput');

            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            layananSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');

                hargaInputFormat.value = harga ? formatRupiah(harga) : '';
                hargaInput.value = harga || '';
            });

            // Auto set saat halaman load
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            if (selectedOption) {
                const hargaAwal = selectedOption.getAttribute('data-harga');
                if (hargaAwal) {
                    hargaInputFormat.value = formatRupiah(hargaAwal);
                    hargaInput.value = hargaAwal;
                }
            }
        });
    </script>
</div>
@endsection
