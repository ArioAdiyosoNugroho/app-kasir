<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanBulanan(Request $request)
    {
        // Ambil bulan dan tahun dari request, default ke bulan dan tahun saat ini,AKKHHHHHH!!!!
        $bulan = $request->input('bulan', Carbon::now()->format('m'));
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));

        // Ambil data penjualan
        $penjualan = Penjualan::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get();

        // Ambil data pembelian
        $pembelian = Pembelian::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get();

        // Ambil data pengeluaran
        $pengeluaran = Pengeluaran::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get();

        // Hitung total penjualan, pembelian, dan pengeluaran
        $totalPenjualan = $penjualan->sum('total_harga');
        $totalPembelian = $pembelian->sum('total_harga');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        // HITUNG GUYS!!
        $pendapatan = $totalPenjualan - $totalPembelian - $totalPengeluaran;

        return view('laporan.bulanan', compact('penjualan', 'pembelian', 'pengeluaran', 'totalPenjualan', 'totalPembelian', 'totalPengeluaran', 'pendapatan', 'bulan', 'tahun'));
    }
}
