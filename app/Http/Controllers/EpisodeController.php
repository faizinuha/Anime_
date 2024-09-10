<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\Anime;

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
            'video' => 'required|file|mimes:mp4,avi,mkv|max:20480', // Maksimal 20MB
            'episode' => 'required|string|unique:episodes,episode,NULL,id,anime_id,' . $request->anime_id, // Kombinasi episode dan anime_id harus unik
            'anime_id' => 'required|exists:animes,id', // Pastikan anime_id valid
        ]);

        // Simpan file video
        $anime = Anime::findOrFail($request->anime_id);
        $animeFolder = 'videos/' . ($anime->name);
        $videoPath = $request->file('video')->store($animeFolder, 'public');


        // // Simpan episode baru

        $episode = Episode::create([
            'video' => $videoPath,
            'episode' => $request->episode,
            'anime_id' => $request->anime_id,
        ]);

        if ($episode) {
            $anime = $episode->anime;
            $episode->anime()->update([
                'episodes' => $anime->animeEpisodes->count()
            ]);
        }

        return redirect()->route('episodes.index')->with('success', 'Episode created successfully.');
    }

    public function newEps()
    {
        // Ambil semua anime untuk dropdown
        $animes = Anime::all();
        return view('episode.neweps', compact('animes'));
    }
    public function createEps(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mkv|max:99999', // Maksimal infinitty
            'episode' => 'required|string',
            'anime_id' => 'required|exists:animes,id',
        ]);
        $anime = Anime::findOrFail($request->anime_id);
        $animeFolder = 'videos/' . ($anime->name);
        $videoPath = $request->file('video')->store($animeFolder, 'public');

        $episode = Episode::create([
            'video' => $videoPath,
            'episode' => $request->episode,
            'anime_id' => $request->anime_id,
        ]);

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
       // Cek jika folder kosong setelah penghapusan video, lalu hapus folder
       
        // Hapus episode dari database
        $episode->delete();

        return redirect()->route('episodes.index')->with('success', 'Episode deleted successfully.');
    }
}
