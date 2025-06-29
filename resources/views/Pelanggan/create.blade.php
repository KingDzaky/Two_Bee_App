@extends('layouts.app')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Tambah Pelanggan</h2>
        <form action="{{ route('pelanggan.store') }}" method="POST">@csrf
            <div class="block text-sm font-medium text-gray-700"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
            <div class="block text-sm font-medium text-gray-700"><label>Alamat</label><textarea name="alamat" class="form-control" required></textarea></div>
            <div class="block text-sm font-medium text-gray-700"><label>Telepon</label><input type="text" name="telepon" class="form-control" required></div>
            <div class="block text-sm font-medium text-gray-600"><label>Email</label><input type="email" name="email" class="form-control"></div>


            <div class="mt-3"><button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">Simpan</button></div>

        </form>
    </div>
</div>
@endsection
