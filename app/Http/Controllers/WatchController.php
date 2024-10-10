<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Comment;
use App\Models\Episode;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function show($name, Episode $episode)
    {
        // Ambil anime berdasarkan nama
        $anime = Anime::where('name', $name)->first();

        // Cek apakah anime ditemukan
        if (!$anime) {
            return redirect()->back()->with('error', 'Anime tidak ditemukan');
        }

        $comments = Comment::where('anime_id', $anime->id)->with('parent.user')->get();
        return view('Anim.watch', compact('anime', 'comments', 'episode'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'anime_id' => 'required|exists:animes,id',
            'content' => 'required|string|max:1000', // Tambahkan validasi panjang konten
        ]);

        // Menyimpan komentar baru
        Comment::create([
            'anime_id' => $request->anime_id,
            'user_id' => auth()->id(),
            'content' => $request->input('content'), // Ganti dengan input yang benar
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
