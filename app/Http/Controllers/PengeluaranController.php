<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Pengeluaran::orderBy('created_at', 'asc')->paginate(10);
        return view('pengeluaran.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengeluaran.addpengeluaran');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|min:0',
            'nominal' => 'required|numeric|min:0',
        ], [
            'deskripsi.required' => 'Harap mengisi deskripsi pengeluaran',
            'nominal.required' => 'Harap mengisi nominal pengeluaran',
        ]);

        // Store the current date in standard format
        $currentDate = Carbon::now();

        $data = [
            'created_at' => $currentDate,
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
        ];

        Pengeluaran::create($data);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
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
        $pengeluaran = Pengeluaran::where('id_pengeluaran', $id)->first();
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'deskripsi' => 'required|string|min:0',
            'nominal' => 'required|numeric|min:0',
        ], [
            'deskripsi.required' => 'Harap mengisi deskripsi pengeluaran',
            'nominal.required' => 'Harap mengisi nominal pengeluaran',
        ]);

        $pengeluaran = Pengeluaran::where('id_pengeluaran', $id)->first();

        // Store the current date in standard format
        $currentDate = Carbon::now();

        $data = [
            'created_at' => $currentDate,
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
        ];

        $pengeluaran->update($data);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus');
    }
}
