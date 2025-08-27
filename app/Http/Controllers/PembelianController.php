<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $data = Pembelian::with('suplier')->orderBy('created_at', 'desc')->paginate(10);
        $supliers = Suplier::orderBy('nama')->get();
        return view('pembelian.index', compact('supliers', 'data'));
    }

    public function create($id)
    {
        $suplier = Suplier::findOrFail($id);
        $produkList = Produk::all();
        return view('pembelian.transaksi', compact('suplier', 'produkList'));
    }

    public function store(Request $request)
    {
        // logger($request->all()); // masuk ke laravel.log

        // dd($request->all());
        $request->validate([
            'id_supplier' => 'required|exists:supplier,id_supplier',
            'produk.*.kode_produk' => 'required|exists:produk,kode_produk',
            'produk.*.jumlah' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'bayar' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalHarga = 0;
            $totalItem = 0;
            $produkDetails = [];

            foreach ($request->produk as $produk) {
                $item = Produk::where('kode_produk', $produk['kode_produk'])->first();
                if (!$item) {
                    return back()->withErrors('Produk dengan kode ' . $produk['kode_produk'] . ' tidak ditemukan.');
                }
                $jumlah = $produk['jumlah'];
                $subtotal = $item->harga_beli * $jumlah;
                $totalHarga += $subtotal;
                $totalItem += $jumlah;

                $item->stok += $jumlah;
                $item->save();

                $produkDetails[] = [
                    'nama_produk' => $item->nama_produk,
                    'id_produk' => $item->id_produk,
                    'kode_produk' => $item->kode_produk,
                    'harga_beli' => $item->harga_beli,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }

            $diskon = $request->diskon ?? 0;
            $totalHargaDenganDiskon = $totalHarga * (1 - $diskon / 100);
            $kembalian = $request->bayar - $totalHargaDenganDiskon;
            $bayar = $request->bayar;

            $pembelian = Pembelian::create([
                'id_supplier' => $request->id_supplier,
                'total_item' => $totalItem,
                'total_harga' => $totalHargaDenganDiskon,
                'diskon' => $diskon,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
            ]);

            foreach ($produkDetails as $detail) {
                PembelianDetail::create([
                    'id_pembelian' => $pembelian->id_pembelian,
                    'id_produk' => $detail['id_produk'],
                    'harga_beli' => $detail['harga_beli'],
                    'jumlah' => $detail['jumlah'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            DB::commit();

            $suplier = Suplier::findOrFail($request->id_supplier);

            return view('pembelian.receipt', compact(
                'suplier',
                'produkDetails',
                'totalHarga',
                'diskon',
                'totalHargaDenganDiskon',
                'bayar',
                'kembalian'
            ));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Halaman untuk memilih supplier
    public function chooseSuplier()
    {
        $supliers = Suplier::all();
        return view('pembelian.chooseSuplier', compact('supliers'));
    }

    public function showTransaksi($id_supplier)
    {
        $suplier = Suplier::findOrFail($id_supplier);
        $produk = Produk::all();
        return view('pembelian.transaksi', compact('suplier', 'produk'));
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('suplier', 'items.produk')->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }


    public function edit($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $supliers  = Suplier::all();
        return view('pembelian.edit', compact('pembelian', 'supliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_supplier' => 'required|exists:supplier,id_supplier',
            'total_item'  => 'required|numeric',
            'total_harga' => 'required|numeric',
            'diskon'      => 'nullable|numeric|min:0',
            'bayar'       => 'required|numeric',
        ]);

        $pembelian = Pembelian::findOrFail($id);
        $pembelian->update([
            'id_supplier' => $request->id_supplier,
            'total_item'  => $request->total_item,
            'total_harga' => $request->total_harga,
            'diskon'      => $request->diskon ?? 0,
            'bayar'       => $request->bayar,
            'updated_at'  => now(),
        ]);

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diupdate');
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus');
    }
}
