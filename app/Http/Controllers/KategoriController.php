<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jumlahbaris =10;
        $katakunci = $request->katakunci;
        if(strlen($katakunci)){
            $data = Kategori::where('nama_kategori', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);

        }else {
            $data = Kategori::orderBy('created_at', 'desc')->paginate($jumlahbaris);
        }
        return view('kategori.index')->with('data', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori,nama_kategori',
        ],[
            'nama_kategori.required' => 'Harap mengisi kategori',
            'nama_kategori.string' => 'Nama kategori harus berupa string',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        session()->flash('nama_kategori', $request->nama_kategori);

        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];

        Kategori::create($data);

     return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Kategori::where('id_kategori', $id)->first();
        return view('kategori.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori,nama_kategori',
        ],[
            'nama_kategori.required' => 'Harap mengisi kategori',
            'nama_kategori.string' => 'Nama kategori harus berupa string',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        // Menyimpan flash message
        session()->flash('nama_kategori', $request->nama_kategori);

        // Menyimpan data kategori ke database
        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];

        Kategori::where('nama_kategori',$id)->update($data);

     return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!is_numeric($id)) {
            return redirect()->route('kategori.index')->with('error', 'ID kategori tidak valid');
        }

        Kategori::where('id_kategori', $id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
