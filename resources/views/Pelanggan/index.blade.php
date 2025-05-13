@extends('layouts.app')

@section('content')
<div class="overflow-x-auto mt-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar Pelanggan</h2>
        <a href="{{ route('pelanggan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Pelanggan</a>
    </div>

    <form action="{{ route('pelanggan.index') }}" method="GET" class="mb-6">
        <div class="flex gap-2">
            <input type="text" name="search" class="w-full border border-black-300 rounded px-3 py-2" placeholder="Cari nama Pelanggan..." value="{{ request('search') }}">
            <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Cari</button>
        </div>
    </form>

    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Alamat</th>
                <th class="px-4 py-2 text-left">Telepon</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-800 divide-y divide-gray-200">
            @forelse($pelanggans as $p)
                <tr>
                    <td class="px-4 py-2">{{ $p->nama }}</td>
                    <td class="px-4 py-2">{{ $p->alamat }}</td>
                    <td class="px-4 py-2">{{ $p->telepon }}</td>
                    <td class="px-4 py-2">{{ $p->email }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('pelanggan.edit', $p->id) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-medium px-3 py-1 rounded">
                            Edit
                        </a>
                        <a href="{{ route('pelanggan.show', $p->id) }}"
                            class="bg-blue-400 hover:bg-yellow-500 text-white text-sm font-medium px-3 py-1 rounded">
                            Show
                        </a>
                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        Belum ada data pelanggan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
