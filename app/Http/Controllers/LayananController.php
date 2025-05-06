<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // Menampilkan daftar layanan
    public function index(Request $request)
    {
        $layanans = Layanan::all();
        $keyword = $request->input('search');

        $layanans = Layanan::when($keyword, function ($query) use ($keyword) {
            $query->where('nama_layanan', 'like', '%' . $keyword . '%');
        })->get();

        return view('layanan.index', compact('layanans'));
    }

    // Menampilkan form tambah layanan
    public function create()
    {
        return view('layanan.create');
    }

    // Menyimpan data layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Layanan::create($request->all());

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Menampilkan detail (opsional, bisa dikosongkan dulu)
    public function show(Layanan $layanan)
    {
        return view('layanan.show', compact('layanan'));
    }

    // Menampilkan form edit layanan
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    // Memperbarui data layanan
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $layanan->update($request->all());

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    // Menghapus data layanan
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
