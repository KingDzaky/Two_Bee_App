@extends('layouts.app')

@section('content')
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i> Detail Orderan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-600 font-semibold">Nama:</p>
                <p class="text-lg">{{ $orderan->pelanggan->nama }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Alamat:</p>
                <p class="text-lg">{{ $orderan->pelanggan->alamat }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Telepon:</p>
                <p class="text-lg">{{ $orderan->pelanggan->telepon }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Email:</p>
                <p class="text-lg">{{ $orderan->pelanggan->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Tanggal Order:</p>
                <p class="text-lg">{{ \Carbon\Carbon::parse($orderan->tanggal)->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Tipe Layanan:</p>
                <p class="text-lg">{{ $orderan->layanan->nama_layanan }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Harga:</p>
                <p class="text-lg font-bold text-green-500">Rp{{ number_format($orderan->harga, 0 ) }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">No Nota:</p>
                <p class="text-lg">{{ $orderan->no_nota }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Status:</p>
                <span class="inline-block px-3 py-1 text-sm rounded-full
                    @if($orderan->status == 'Proses') bg-yellow-200 text-yellow-800
                    @elseif($orderan->status == 'Selesai') bg-green-200 text-green-800
                    @else bg-blue-200 text-blue-800 @endif">
                    {{ $orderan->status }}
                </span>
            </div>
        </div>

          <!-- Bagian Pembayaran -->
          <h2 class="text-xl font-semibold">Pembayaran</h2>
          <p>Silakan transfer ke rekening berikut:</p>
          <div class="p-4 bg-gray-100 rounded">
              <p><strong>Bank:</strong> BNI</p>
              <p><strong>No Rekening:</strong> 1772618281</p>
              <p><strong>Atas Nama:</strong> Dzaky Akmal Rizqullah</p>
          </div>


        <div class="mt-8">
            <a href="{{ route('orderan.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>

            <a href="{{ route('orderan.cetakPdf', $orderan->id) }}" target="_blank">
                <button>Cetak PDF</button>
            </a>




        </div>
    </div>

</div>
@endsection
