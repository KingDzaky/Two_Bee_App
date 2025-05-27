@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Tambah Orderan</h2>

        <form action="{{ route('orderan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- Pelanggan -->
                <select id="pelanggan_id" name="pelanggan_id" class="form-control" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}"
                            data-alamat="{{ $pelanggan->alamat }}"
                            data-telepon="{{ $pelanggan->telepon }}"
                            data-email="{{ $pelanggan->email }}">
                            {{ $pelanggan->nama }}
                        </option>
                    @endforeach
                </select>

                <input type="text" id="alamat" name="alamat" class="form-control" readonly>
                <input type="text" id="telepon" name="telepon" class="form-control" readonly>
                <input type="email" id="email" name="email" class="form-control" readonly>

                <!-- Tanggal Order -->
                <div>
                    <label class="block font-medium mb-1">Tanggal Order</label>
                    <input type="date" name="tanggal" class="w-full border p-2 rounded" required>
                </div>

                <!-- Waktu -->
                <div>
                    <label class="block font-medium mb-1">Waktu</label>
                    <input type="time" name="waktu" class="w-full border p-2 rounded" required>
                </div>

                <!-- No Nota -->
                <div>
                    <label class="block font-medium mb-1">No Nota</label>
                    <input type="text" name="no_nota" class="w-full border p-2 rounded" required>
                </div>

                <!-- Tipe Layanan -->
                <div>
                    <label class="block font-medium mb-1">Tipe Layanan</label>
                    <select name="layanan_id" id="layananSelect" class="border rounded p-2 w-full" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($layanans as $layanan)
                            <option value="{{ $layanan->id }}"
                                data-harga="{{ $layanan->harga }}"
                                data-nama="{{ $layanan->nama_layanan }}">
                                {{ $layanan->id }} - {{ $layanan->nama_layanan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="tipe_layanan" id="tipe_layanan">

                <div>
                    <label class="block font-medium mb-1">Harga</label>
                    <input type="hidden" name="harga" id="hargaInput">
                    <input type="text" id="hargaInputFormat" class="border p-2 w-full mt-2" readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" class="border p-2 w-full rounded" accept="image/*">
                </div>

                <!-- Status -->
                <div class="col-span-2">
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status" class="w-full border p-2 rounded" required>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Diantar">Diantar</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Simpan Orderan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script: Update harga & layanan saat pilih layanan -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layananSelect = document.getElementById('layananSelect');
        const hargaInput = document.getElementById('hargaInput');
        const hargaInputFormat = document.getElementById('hargaInputFormat');
        const tipeLayananInput = document.getElementById('tipe_layanan');

        layananSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const harga = selected.getAttribute('data-harga');
            const namaLayanan = selected.getAttribute('data-nama');

            if (harga) {
                hargaInput.value = harga;
                tipeLayananInput.value = namaLayanan;

                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(harga);

                hargaInputFormat.value = formatted;
            } else {
                hargaInput.value = '';
                hargaInputFormat.value = '';
                tipeLayananInput.value = '';
            }
        });
    });
</script>

<!-- Script: Update data pelanggan -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pelangganSelect = document.getElementById('pelanggan_id');

        pelangganSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            document.getElementById('alamat').value = selected.getAttribute('data-alamat') || '';
            document.getElementById('telepon').value = selected.getAttribute('data-telepon') || '';
            document.getElementById('email').value = selected.getAttribute('data-email') || '';
        });
    });
</script>
@endsection
