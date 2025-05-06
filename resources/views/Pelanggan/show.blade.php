@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Detail Pelanggan</h2>

    <div class="mb-3">
        <strong class="block text-gray-600">Nama:</strong>
        <p>{{ $pelanggan->nama }}</p>
    </div>

    <div class="mb-3">
        <strong class="block text-gray-600">Alamat:</strong>
        <p>{{ $pelanggan->alamat }}</p>
    </div>

    <div class="mb-3">
        <strong class="block text-gray-600">Telepon:</strong>
        <p>{{ $pelanggan->telepon }}</p>
    </div>

    <div class="mb-3">
        <strong class="block text-gray-600">Email:</strong>
        <p>{{ $pelanggan->email }}</p>
    </div>

    <div class="mt-5">
        <a href="{{ route('pelanggan.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar pelanggan</a>
    </div>
</div>
@endsection
