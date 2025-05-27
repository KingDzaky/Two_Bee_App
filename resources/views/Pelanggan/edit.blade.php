@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit Data Pelanggan</h2>

        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" value="{{ $pelanggan->nama }}"
                    class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            {{-- Alamat --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat"
                    class="w-full border border-gray-300 p-2 rounded resize-none"
                    required>{{ $pelanggan->alamat }}</textarea>
            </div>

            {{-- Telepon --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                <input type="text" name="telepon" value="{{ $pelanggan->telepon }}"
                    class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            {{-- Email --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $pelanggan->email }}"
                    class="w-full border border-gray-300 p-2 rounded">
            </div>

            {{-- Tombol Submit --}}
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</div>
@endsection
