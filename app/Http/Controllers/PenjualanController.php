<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Member;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $query = Penjualan::query();

        if (Auth::user()->level == 0) {
            // Kasir hanya dapat melihat transaksi mereka sendiri
            $query->where('id_user', Auth::id());
        }

        // if ($request->has('katakunci')) {
        //     $query->where('nama_produk', 'like', '%' . $request->katakunci . '%');
        // }

        $data = $query->with('member', 'user')->orderBy('created_at', 'desc')->paginate(10);
        $members = Member::orderBy('nama')->get();

        return view('penjualan.index', compact('members', 'data'));
    }

    // Form untuk menambah Penjualan (transaksi) berdasarkan id_member
    public function create()
    {
        $members = Member::all();
        $produk = Produk::all();
        return view('penjualan.addtransaksi', compact('members', 'produk'));
    }

    // Menyimpan Penjualan baru dan detailnya
    public function store(Request $request)
    {
        $request->validate([
            'id_member' => 'nullable|exists:member,id_member',
            'produk.*.kode_produk' => 'required|exists:produk,kode_produk',
            'produk.*.jumlah' => 'required|integer|min:1',
            'bayar' => 'required|numeric|min:0',
            'diskon' => 'min:0|max:100',
        ]);

        DB::beginTransaction();
        try {
            $totalHarga = 0;
            $totalItem = 0;
            $produkDetails = [];

            foreach ($request->produk as $produk) {
                $item = Produk::where('kode_produk', $produk['kode_produk'])->first();
                $jumlah = $produk['jumlah'];
                $subtotal = $item->harga_jual * $jumlah;
                $totalHarga += $subtotal;
                $totalItem += $jumlah;

                // Kurangi stok produk
                if ($item->stok < $jumlah) {
                    throw new \Exception('Stok produk ' . $item->nama_produk . ' tidak mencukupi.');
                }
                $item->stok -= $jumlah;
                $item->save();

                $produkDetails[] = [
                    'id_produk' => $item->id_produk,
                    'kode_produk' => $item->kode_produk,
                    'harga_jual' => $item->harga_jual,
                    'jumlah' => $jumlah,
                    'diskon' => $request->diskon ?? 0,
                    'subtotal' => $subtotal,
                ];
            }

            $diskon = $request->diskon ?? 0;
            $totalHargaDenganDiskon = $totalHarga * (1 - $diskon / 100);
            $kembalian = $request->bayar - $totalHargaDenganDiskon;
            $bayar = $request->bayar;

            $penjualan = Penjualan::create([
                'id_member' => $request->id_member,
                'total_item' => $totalItem,
                'total_harga' => $totalHarga, // Simpan total harga sebelum diskon
                'diskon' => $diskon,
                'bayar' => $bayar,
                'diterima' => $request->bayar,
                'id_user' => Auth::user()->id,
            ]);

            foreach ($produkDetails as $detail) {
                PenjualanDetail::create([
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_produk' => $detail['id_produk'],
                    'harga_jual' => $detail['harga_jual'],
                    'jumlah' => $detail['jumlah'],
                    'diskon' => $detail['diskon'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            DB::commit();


            return redirect()->route('penjualan.struk', ['id' => $penjualan->id_penjualan]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Halaman untuk memilih member
    public function choosemember()
    {
        $members = Member::all();
        return view('Penjualan.choosemember', compact('members'));
    }

    // Halaman untuk transaksi Penjualan (menampilkan form transaksi)
    public function showTransaksi($id_member)
    {
        $member = Member::findOrFail($id_member);
        $produk = Produk::all();
        return view('Penjualan.transaksi', compact('member', 'produk'));
    }

    public function show($id)
    {
        // Ambil data penjualan beserta relasi user dan detail produk
        $penjualan = Penjualan::with('user', 'items.produk')->findOrFail($id);
        $produkDetails = $penjualan->items->map(function ($item) {
            return [
                'nama_produk' => $item->produk->nama_produk,
                'kode_produk' => $item->produk->kode_produk,
                'harga_jual' => $item->harga_jual,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->subtotal,
            ];
        });

        $totalHarga = $penjualan->items->sum('subtotal'); // Hitung total harga dari subtotal item
        $diskon = $penjualan->diskon;
        $totalHargaDenganDiskon = $totalHarga * (1 - $diskon / 100);
        $bayar = $penjualan->bayar;
        $kembalian = $penjualan->diterima - $totalHargaDenganDiskon;

        return view('penjualan.show', compact('penjualan', 'produkDetails', 'totalHarga', 'diskon', 'totalHargaDenganDiskon', 'bayar', 'kembalian'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $Penjualan = Penjualan::findOrFail($id);
        $members  = Member::all();
        return view('Penjualan.edit', compact('Penjualan', 'members'));
    }

    // Mengupdate data Penjualan
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_member' => 'required|exists:member,id_member',
            'total_item'  => 'required|numeric',
            'total_harga' => 'required|numeric',
            'diskon'      => 'nullable|numeric|min:0|max:100',
            'bayar'       => 'required|numeric',
        ]);

        $Penjualan = Penjualan::findOrFail($id);
        $Penjualan->update([
            'id_member' => $request->id_member,
            'total_item'  => $request->total_item,
            'total_harga' => $request->total_harga,
            'diskon'      => $request->diskon ?? 0,
            'bayar'       => $request->bayar,
            'updated_at'  => now(),
        ]);

        return redirect()->route('Penjualan.index')->with('success', 'Penjualan berhasil diupdate');
    }

    // Menghapus data Penjualan
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }

    public function showStruk($id)
    {
        $penjualan = Penjualan::with('user', 'items.produk')->findOrFail($id);
        $produkDetails = $penjualan->items->map(function ($item) {
            return [
                'nama_produk' => $item->produk->nama_produk,
                'kode_produk' => $item->produk->kode_produk,
                'harga_jual' => $item->harga_jual,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->subtotal,
            ];
        });

        $totalHarga = $penjualan->items->sum('subtotal'); // Hitung total harga dari subtotal item
        $diskon = $penjualan->diskon;
        $totalHargaDenganDiskon = $totalHarga * (1 - $diskon / 100);
        $bayar = $penjualan->bayar;
        $kembalian = $penjualan->diterima - $totalHargaDenganDiskon;

        return view('penjualan.struk', compact('penjualan', 'produkDetails', 'totalHarga', 'diskon', 'totalHargaDenganDiskon', 'bayar', 'kembalian'));
    }
}
