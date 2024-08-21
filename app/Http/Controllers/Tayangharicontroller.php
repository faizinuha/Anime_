<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tayang_Hari;

class Tayangharicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data hari
        $hari = Tayang_Hari::all();
        return view('tayanghari.Hari', compact('hari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambah hari baru
        return view('tayanghari.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Menyimpan data hari baru
        Tayang_Hari::create($request->all());

        return redirect()->route('Tayanghari.index')
                         ->with('success', 'Hari berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     // Menampilkan detail hari berdasarkan ID
    //     $tayangHari = Tayang_Hari::findOrFail($id);
    //     return view('Tayang', compact('tayangHari'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Menampilkan form untuk mengedit hari berdasarkan ID
        $tayangHari = Tayang_Hari::findOrFail($id);
        return view('Tayanghari.edit', compact('tayangHari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Mengupdate data hari
        $tayangHari = Tayang_Hari::findOrFail($id);
        $tayangHari->update($request->all());

        return redirect()->route('Tayanghari.index')
                         ->with('success', 'Hari berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus data hari berdasarkan ID
        $tayangHari = Tayang_Hari::findOrFail($id);
        $tayangHari->delete();

        return redirect()->route('Tayanghari.index')
                         ->with('success', 'Hari berhasil dihapus');
    }
}
