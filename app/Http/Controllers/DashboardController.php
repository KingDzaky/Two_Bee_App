<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderan;
use App\Models\Layanan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPelanggan = Pelanggan::count();
        $jumlahOrder = Orderan::count();
        $totalPendapatan = Orderan::sum('harga');

        // Status order
        $orderProses = Orderan::where('status', 'proses')->count();
        $orderSelesai = Orderan::where('status', 'selesai')->count();
        $orderDiantar = Orderan::where('status', 'diantar')->count();

        // Grafik orderan per tanggal
        $orderanChart = Orderan::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as tanggal"),
            DB::raw("COUNT(*) as total_order"),
            DB::raw("SUM(harga) as total_pendapatan")
        )
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
        ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
        ->get()
        ->map(function ($item) {
            // pastikan tanggal jadi string biasa
            $item->tanggal = (string) $item->tanggal;
            return $item;

        });


        // Grafik layanan favorit
        $layananFavorit = Orderan::join('layanans', 'orderans.layanan_id', '=', 'layanans.id')
            ->select('layanans.nama_layanan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('layanans.nama_layanan')
            ->orderByDesc('jumlah')
            ->get();

        return view('dashboard.index', compact(
            'jumlahPelanggan',
            'jumlahOrder',
            'totalPendapatan',
            'orderProses',
            'orderSelesai',
            'orderDiantar',
            'orderanChart',
            'layananFavorit'
        ));
    }
}
