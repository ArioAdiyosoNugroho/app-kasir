<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Member::orderBy('nama', 'asc')->paginate(10);
        return view('member.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.addmember');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:member,nama',
            'alamat' => 'required|string|min:0',
            'telepon' => 'required|numeric|min:0',
        ], [
            'nama.required' => 'Harap mengisi nama member',
            'alamat.required' => 'Harap mengisi alamat member',
            'telepon.required' => 'Harap mengisi nomor telepon member',
            'nama.unique' => 'Nama member sudah ada',
        ]);

        // Generate a random 5-digit number for kode_member
        $randomId = mt_rand(10000, 99999);
        $kodeMember = str_pad($randomId, 7, '0', STR_PAD_LEFT);

        $data = [
            'nama' => $request->nama,
            'kode_member' => $kodeMember,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ];

        Member::create($data);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan');
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
        $member = Member::where('id_member', $id)->first();
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:member,nama,' . $id . ',id_member',
            'alamat' => 'required|string|min:0',
            'telepon' => 'required|numeric|min:0',
        ], [
            'nama.required' => 'Harap mengisi nama member',
            'alamat.required' => 'Harap mengisi alamat member',
            'telepon.required' => 'Harap mengisi nomor telepon member',
            'nama.unique' => 'Nama member sudah ada',
        ]);

        $member = Member::where('id_member', $id)->first();

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ];

        $member->update($data);

        return redirect()->route('member.index')->with('success', 'Member berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus');
    }
}