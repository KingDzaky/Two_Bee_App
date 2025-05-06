@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar Layanan</h2>
        <a href="{{ route('layanan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Layanan</a>
    </div>

    @if($layanans->isEmpty())
        <div class="bg-blue-100 border border-blue-300 text-blue-700 px-4 py-3 rounded mb-4">
            Belum ada layanan.
        </div>
    @else

    <!-- Form Pencarian -->
    <form action="{{ route('layanan.index') }}" method="GET" class="mb-6">
        <div class="flex gap-2">
            <input type="text" name="search" class="w-full border border-black-300 rounded px-3 py-2" placeholder="Cari nama layanan..." value="{{ request('search') }}">
            <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Cari</button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Layanan</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Deskripsi</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $index => $layanan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $layanan->nama_layanan }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $layanan->deskripsi }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('layanan.edit', $layanan->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">Edit</a>
                            <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin mau hapus layanan ini?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif
</div>
@endsection
