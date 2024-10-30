<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NobarAnime;
use App\Models\Anime;
use App\Models\User; // Model User untuk peserta
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class NobarAnimeController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $roms = $status ? NobarAnime::where('status', $status)->get() : NobarAnime::all();
        return view('roms.index', compact('roms', 'status'));
    }

    public function create()
    {
        $animes = Anime::all();
        return view('roms.create', compact('animes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key_rom' => 'required|min:6',
            'tanggal_waktu' => 'required',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'jumlah_peserta' => 'required|integer|min:1',
            'anime_id' => 'required|exists:animes,id',
            // 'comment_id' => 'required|exists:comments,id', // pastikan ini valid
        ]);

        $user = Auth::user();

        $nobarAnime = NobarAnime::create([
            'key_rom' => $request->key_rom,
            'anime_id' => $request->anime_id,
            'tanggal_waktu' => $request->tanggal_waktu,
            'deskripsi' => $request->deskripsi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'status' => $request->status,
            'user_id' => $user->id,
            // 'comment_id' => $request->comment_id, // menggunakan ID komentar dari request
        ]);

        $entryTime = new \DateTime($nobarAnime->tanggal_waktu);
        $fourAMNextDay = new \DateTime('tomorrow 04:00:00');

        if ($entryTime > $fourAMNextDay) {
            $nobarAnime->delete();
            return redirect()->route('roms.index')->with('error', 'Rom tidak dapat dibuat karena waktu lebih dari jam 4 pagi.');
        }

        $nobarAnime->users()->attach($user->id);

        return redirect()->route('roms.show', $nobarAnime->id)->with('success', 'Rom berhasil dibuat dan Anda telah bergabung!');
    }

    public function edit($id)
    {
        $rom = NobarAnime::findOrFail($id);
        $animes = Anime::all();
        return view('roms.edit', compact('rom', 'animes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'key_rom' => 'required|min:6',
            'tanggal_waktu' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'jumlah_peserta' => 'required|integer|min:1',
            'anime_id' => 'required|exists:animes,id',
            'comment_id' => 'required',
        ]);

        $rom = NobarAnime::findOrFail($id);
        $rom->update($request->only(['key_rom', 'anime_id', 'tanggal_waktu', 'deskripsi', 'jumlah_peserta', 'status']));

        return redirect()->route('roms.index')->with('success', 'Rom berhasil diperbarui!');
    }




    public function show($id)
    {
        $rom = NobarAnime::findOrFail($id);
        $peserta = $rom->users;
        $comments = Comment::where('anime_id', $rom->anime->id)->get(); // Mengambil semua komentar
        return view('roms.show', compact('rom', 'peserta', 'comments'));
    }
we


    public function leave($id)
    {
        $rom = NobarAnime::findOrFail($id);
        $user = Auth::user();

        if ($rom->users()->where('user_id', $user->id)->exists()) {
            $rom->users()->detach($user->id);
            $rom->decrement('jumlah_peserta');
        }

        return redirect()->route('roms.index')->with('success', 'Anda telah keluar dari rom.');
    }

    public function joinRoom(Request $request, $id)
    {
        $request->validate([
            'key_rom' => 'required|string',
        ]);

        $rom = NobarAnime::findOrFail($id);

        if ($request->key_rom === $rom->key_rom) {
            $user = Auth::user();

            if (!$rom->users()->where('user_id', $user->id)->exists()) {
                $rom->users()->attach($user->id);
                $rom->increment('jumlah_peserta');
            }

            return redirect()->route('roms.show', $id)->with('success', 'Anda berhasil bergabung ke rom ini!');
        } else {
            return redirect()->back()->withErrors(['key_rom' => 'Key Rom tidak valid.']);
        }
    }

    public function watching($id)
    {
        $rom = NobarAnime::with('anime')->where('id', $id)->firstOrFail();
        return view('Roms.watch-nobar', compact('rom'));
    }
}
