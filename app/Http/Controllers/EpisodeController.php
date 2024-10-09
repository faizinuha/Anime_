<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Anime;
use Illuminate\Support\Str;

class EpisodeController extends Controller
{
    /**
     * Show the form for creating a new episode.
     */
    public function index()
    {
        $episodes = Episode::with('anime')->get();
        return view('episode.episodes', compact('episodes'));
    }

    public function create()
    {
        // Ambil semua anime untuk dropdown
        $animes = Anime::all();
        return view('episode.create', compact('animes'));
    }

    /**
     * Store a newly created episode in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mkv|max:99999', // Maksimal 20MB
            'episode' => 'required|string|unique:episodes,episode,NULL,id,anime_id,' . $request->anime_id, // Kombinasi episode dan anime_id harus unik
            'anime_id' => 'required|exists:animes,id', // Pastikan anime_id valid
        ]);

        // Temukan anime berdasarkan ID
        $anime = Anime::findOrFail($request->anime_id);
        
        // Gunakan slug untuk nama folder yang lebih aman
        $animeFolder = 'videos/' . Str::slug($anime->name);

        // Cek apakah folder sudah ada, jika tidak buat folder
        if (!Storage::disk('public')->exists($animeFolder)) {
            Storage::disk('public')->makeDirectory($animeFolder);
        }

        // Simpan file video
        $videoPath = $request->file('video')->store($animeFolder, 'public');

        // Simpan episode baru
        $episode = Episode::create([
            'video' => $videoPath,
            'episode' => $request->episode,
            'anime_id' => $request->anime_id,
        ]);

        // Update jumlah episode pada anime yang bersangkutan
        if ($episode) {
            $anime = $episode->anime;
            $episode->anime()->update([
                'episodes' => $anime->animeEpisodes->count()
            ]);
        }

        return redirect()->route('episodes.index')->with('success', 'Episode created successfully.');
    }

    /**
     * Show the form for adding new episodes.
     */
    public function newEps()
    {
        // Ambil semua anime untuk dropdown
        $animes = Anime::all();
        return view('episode.neweps', compact('animes'));
    }

    /**
     * Store a new episode.
     */
    public function createEps(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mkv|max:99999', // Maksimal infinity
            'episode' => 'required|string',
            'anime_id' => 'required|exists:animes,id',
        ]);

        $anime = Anime::findOrFail($request->anime_id);
        $animeFolder = 'videos/' . Str::slug($anime->name);

        // Cek apakah folder sudah ada, jika tidak buat folder
        if (!Storage::disk('public')->exists($animeFolder)) {
            Storage::disk('public')->makeDirectory($animeFolder);
        }

        $videoPath = $request->file('video')->store($animeFolder, 'public');

        $episode = Episode::create([
            'video' => $videoPath,
            'episode' => $request->episode,
            'anime_id' => $request->anime_id,
        ]);

        // Update jumlah episode pada anime
        if ($episode) {
            $anime = Anime::find($request->anime_id); // Find the associated anime
            $anime->update([
                'episodes' => $anime->animeEpisodes()->count() // Update the episodes count field
            ]);
        }

        return redirect()->route('episodes.index')->with('success', 'Episode Berhasil Tambah');
    }

    /**
     * Remove the specified episode from storage.
     */
    public function destroy($id)
    {
        $episode = Episode::findOrFail($id);

        // Pastikan episode memiliki file video yang tersimpan
        if ($episode->video) {
            // Hapus file video dari folder berdasarkan path yang ada di database
            Storage::disk('public')->delete($episode->video);

            $animeFolder = dirname($episode->video);
            // Jika folder kosong, hapus folder
            if (empty(Storage::disk('public')->allFiles($animeFolder))) {
                Storage::disk('public')->deleteDirectory($animeFolder);
            }
        }

        // Hapus episode dari database
        $episode->delete();

        return redirect()->route('episodes.index')->with('success', 'Episode deleted successfully.');
    }
}
