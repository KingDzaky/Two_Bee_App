<?php

namespace App\Http\Controllers;

use App\Models\Orderan;
use App\Models\Layanan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class OrderanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $orderans = Orderan::with('pelanggan', 'layanan')
            ->when($search, function ($query, $search) {
                $query->where('no_nota', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->get();

        return view('orderan.index', compact('orderans'));


    }

    public function create()
    {
        $layanans = Layanan::all();
        $pelanggans = Pelanggan::all();
        return view('orderan.create', compact('layanans', 'pelanggans'));
    }


    public function store(Request $request)
    {
        // VALIDASI input dasar
        $validatedData = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id' => 'required|exists:layanans,id',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'harga' => 'required|numeric',
            'no_nota' => 'required|string|unique:orderans',
            'status' => 'required|in:Proses,Selesai,Diantar',
        ]);

        $validatedData['layanan_id'] = $request->layanan_id; // ✅ TAMBAHKAN INI
        // Bersihkan harga dari simbol selain angka
        // $validatedData['harga'] = preg_replace('/[^0-9]/', '', $validatedData['harga']);
        // Simpan data ke database
        // dd($validatedData['harga']);

        Orderan::create($validatedData);

        return redirect()->route('orderan.index')->with('success', 'Orderan berhasil ditambahkan.');
    }

    public function show(Orderan $orderan)
    {
        return view('orderan.show', compact('orderan'));
    }

    public function edit($id)
    {
        $orderan = Orderan::findOrFail($id); // Ambil data berdasarkan ID
        $layanans = Layanan::all(); // kalau kamu pakai list layanan


        $pelanggans = Pelanggan::all();
        return view('orderan.edit', compact('orderan', 'layanans', 'pelanggans'));
    }

    public function update(Request $request, Orderan $orderan)
    {

        $validatedData = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'layanan_id' => 'required|exists:layanans,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'harga' => 'required',
            'no_nota' => 'required|string|unique:orderans,no_nota,' . $orderan->id,
            'status' => 'required|in:Proses,Selesai,Diantar',
        ]);

        // Ambil data pelanggan
        $pelanggan = Pelanggan::find($request->pelanggan_id);

        // Update informasi pelanggan ke orderan
        $validatedData['nama'] = $pelanggan->nama;
        $validatedData['alamat'] = $pelanggan->alamat;
        $validatedData['telepon'] = $pelanggan->telepon;
        $validatedData['email'] = $pelanggan->email;

        // Tambahkan pelanggan_id ke update
        $validatedData['pelanggan_id'] = $pelanggan->id;

        $orderan->update($validatedData);


        return redirect()->route('orderan.index')->with('success', 'Orderan berhasil diperbarui.');
    }

    public function destroy(Orderan $orderan)
    {
        $orderan->delete();
        return redirect()->route('orderan.index')->with('success', 'Orderan berhasil dihapus.');
    }


    public function cetakSemua()
    {
        $orderans = Orderan::with(['pelanggan', 'layanan'])->get();

        $pdf = Pdf::loadView('orderan.cetak-semua', compact('orderans'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream();
    }


    public function cetakPdf(Orderan $orderan)
    {
        $orderan->load('pelanggan'); // pastikan relasi pelanggan dimuat
        $pdf = Pdf::loadView('orderan.cetak', compact('orderan'));
        return $pdf->download('Orderan-' . $orderan->no_nota . '.pdf');


    }



    public function uploadBukti(Request $request, Orderan $orderan)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hapus bukti lama jika ada
        if ($orderan->bukti_transfer) {
            Storage::delete('public/bukti_transfer/' . $orderan->bukti_transfer);
        }

        // Simpan bukti baru
        $fileName = time() . '.' . $request->bukti_transfer->extension();
        $request->bukti_transfer->storeAs('public/bukti_transfer', $fileName);

        $orderan->update(['bukti_transfer' => $fileName]);

        return redirect()->back()->with('success', 'Bukti transfer berhasil diupload!');
    }
}
