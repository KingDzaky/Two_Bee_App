@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Orderan</h1>
        <a href="{{ route('orderan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Tambah Order
        </a>
    </div>



    <form action="{{ route('orderan.index') }}" method="GET" class="mb-6">
        <div class="flex gap-2">
            <input type="text" name="search" class="w-full border border-black-300 rounded px-3 py-2" placeholder="Cari nama Orderan..." value="{{ request('search') }}">
            <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Cari</button>
        </div>
    </form>

    <div class="bg-white shadow-md rounded p-4">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">No Nota</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Waktu</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderans as $orderan)
                <tr class="border-b text-center">
                    <td class="px-4 py-2">{{ $orderan->no_nota }}</td>
                    <td>{{ $orderan->pelanggan->nama ?? $orderan->nama }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($orderan->tanggal)->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $orderan->waktu }}</td>
                    <td class="px-4 py-2">{{ $orderan->harga }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-white
                            @if($orderan->status == 'Proses') bg-yellow-400
                            @elseif($orderan->status == 'Selesai') bg-green-500
                            @else bg-blue-500 @endif">
                            {{ $orderan->status }}
                        </span>
                    </td>
                    <td class="justify-items-center">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('orderan.edit', $orderan->id) }}" class="text-blue-600 hover:underline">
                                Edit
                            </a>
                            <a href="{{ route('orderan.show', $orderan->id) }}" class="text-green-600 hover:underline">
                                Show
                            </a>
                            <form action="{{ route('orderan.destroy', $orderan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>

<a href="{{ route('orderan.cetakSemua') }}" class="btn btn-danger" target="_blank">
    <i class="fa fa-file-pdf"></i> Export PDF Semua
</a>


@endsection
