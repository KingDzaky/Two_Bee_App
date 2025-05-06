@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-4">Edit Layanan</h2>

    <form action="{{ route('layanan.update', $layanan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_layanan" class="block font-medium mb-1">Nama Layanan</label>
            <input type="text" id="nama_layanan" name="nama_layanan" value="{{ $layanan->nama_layanan }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label for="harga" class="block font-medium mb-1">Harga (Rp)</label>
            <input type="number" id="harga" name="harga" value="{{ $layanan->harga }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
    </form>
</div>
@endsection
