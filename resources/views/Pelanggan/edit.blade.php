@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit Data Pelanggan</h2>
    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">@csrf @method('PUT')
        <div class="block text-sm font-medium text-gray-700"><label>Nama</label><input type="text" name="nama" value="{{ $pelanggan->nama }}" class="form-control" required></div>
        <div class="block text-sm font-medium text-gray-700"><label>Alamat</label><textarea name="alamat" class="form-control" required>{{ $pelanggan->alamat }}</textarea></div>
        <div class="block text-sm font-medium text-gray-700"><label>Telepon</label><input type="text" name="telepon" value="{{ $pelanggan->telepon }}" class="form-control" required></div>
        <div class="block text-sm font-medium text-gray-700"><label>Email</label><input type="email" name="email" value="{{ $pelanggan->email }}" class="form-control"></div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
</div>
@endsection
