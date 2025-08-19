<?php

namespace App\Http\Controllers;

use App\Models\suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = suplier::orderBy('nama', 'asc')->paginate(10);
        return view('supplier.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.addsupplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:supplier,nama',
            'alamat' => 'required|string|min:0',
            'telepon' => 'required|numeric|min:0',
        ], [
            'nama.required' => 'Harap mengisi nama supplier',
            'alamat.required' => 'Harap mengisi alamat supplier',
            'telepon.required' => 'Harap mengisi nomor telepon supplier',
            'nama.unique' => 'Nama supplier sudah ada',
        ]);


        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ];

        suplier::create($data);

        return redirect()->route('supplier.index')->with('success', 'supplier berhasil ditambahkan');
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
        $supplier = suplier::where('id_supplier', $id)->first();
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:supplier,nama,' . $id . ',id_supplier',
            'alamat' => 'required|string|min:0',
            'telepon' => 'required|numeric|min:0',
        ], [
            'nama.required' => 'Harap mengisi nama supplier',
            'alamat.required' => 'Harap mengisi alamat supplier',
            'telepon.required' => 'Harap mengisi nomor telepon supplier',
            'nama.unique' => 'Nama supplier sudah ada',
        ]);

        $supplier = suplier::where('id_supplier', $id)->first();

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ];

        $supplier->update($data);

        return redirect()->route('supplier.index')->with('success', 'supplier berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'supplier berhasil dihapus');
    }
}
