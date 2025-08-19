<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk; 
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jumlahbaris =10;
        $katakunci = $request->katakunci;
        if(strlen($katakunci)){
            $data = Produk::where('nama_produk', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);

        }else {
            $data = Produk::with('kategori')  
            ->orderBy('nama_produk', 'asc')
            ->paginate($jumlahbaris);
        }
        return view('produk.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all(); 
        return view('produk.addproduk', compact('kategori')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255|unique:produk,nama_produk',
            'merk' => 'max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'kode_produk' => 'nullable|string|max:255|unique:produk,kode_produk',
        ], [
            'nama_produk.required' => 'Harap mengisi nama produk',
            'harga_beli.required' => 'Harap mengisi harga beli',
            'harga_jual.required' => 'Harap mengisi harga jual',
            'stok.required' => 'Harap mengisi stok',
            'id_kategori.required' => 'Harap memilih kategori',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'nama_produk.unique' => 'Nama produk sudah ada',
            'kode_produk.unique' => 'Kode produk sudah ada',
            'kode_produk.max' => 'Kode produk maksimal 255 karakter',
        ]);

        $data = [
            'nama_produk' => $request->nama_produk,
            'merk' => $request->merk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'diskon' => $request->diskon, // Allow diskon to be null
            'id_kategori' => $request->id_kategori,
            'kode_produk' => $request->kode_produk,
        ];

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::where('id_produk', $id)->first();
        $kategori = Kategori::all();
        return view('produk.edit' ,compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255|unique:produk,nama_produk,' . $produk->id_produk . ',id_produk',
            'merk' => 'max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'kode_produk' => 'nullable|string|max:255|unique:produk,kode_produk,' . $produk->id_produk . ',id_produk',
        ], [
            'nama_produk.required' => 'Harap mengisi nama produk',
            'harga_beli.required' => 'Harap mengisi harga beli',
            'harga_jual.required' => 'Harap mengisi harga jual',
            'stok.required' => 'Harap mengisi stok',
            'id_kategori.required' => 'Harap memilih kategori',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'nama_produk.unique' => 'Nama produk sudah ada',
            'kode_produk.unique' => 'Kode produk sudah ada',
            'kode_produk.max' => 'Kode produk maksimal 255 karakter',
        ]);

        // Menyimpan data produk ke database
        $data = [
            'nama_produk' => $request->nama_produk,
            'merk' => $request->merk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'diskon' => $request->diskon,
            'id_kategori' => $request->id_kategori,
            'kode_produk' => $request->kode_produk,
        ];

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
