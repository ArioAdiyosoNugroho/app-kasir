<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari request, default ke bulan dan tahun saat ini
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

        // Hitung pendapatan (penjualan - pembelian - pengeluaran)
        $pendapatan = $totalPenjualan - $totalPembelian - $totalPengeluaran;
        if (Auth::user()->level == 1) {
            return view('kasir.home', compact('penjualan', 'pembelian', 'pengeluaran', 'totalPenjualan', 'totalPembelian', 'totalPengeluaran', 'pendapatan', 'bulan', 'tahun'));
        } elseif (Auth::user()->level == 0) {
            return view('kasir2.home');
        } else {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');
        }
    }
}
