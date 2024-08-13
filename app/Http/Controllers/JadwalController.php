<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\Anime;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jadwals = Jadwal::with('anime')->get();
        return view('jadwals.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $animes = Anime::all();
        return view('jadwals.create', compact('animes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'anime_id' => 'required|exists:animes,id',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Berhasil Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
        return view('jadwals.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $animes = Anime::all();
        return view('jadwals.edit', compact('jadwal', 'animes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
        $request->validate([
            'anime_id' => 'required|exists:animes,id',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Berhasil Hapus');
    }
}
