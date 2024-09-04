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
            'episode' => 'required|string',
            'anime_id' => 'required|exists:animes,id',
        ]);

        // Simpan file video
        $videoPath = $request->file('video')->store('videos', 'public');

        // // Simpan episode baru
        
        // Episode::create([
        //     'video' => $videoPath,
        //     'episode' => $request->episode,
        //     'anime_id' => $request->anime_id,
        // ]);

        return redirect()->route('episodes.index')->with('success', 'Episode created successfully.');
    }

    /**
     * Remove the specified episode from storage.
     */
    public function destroy($id)
    {
        $episode = Episode::findOrFail($id);

        // Hapus file video dari storage
        if ($episode->video) {
            Storage::disk('public')->delete($episode->video);
        }

        // Hapus episode dari database
        $episode->delete();

        return redirect()->route('episodes.index')->with('success', 'Episode deleted successfully.');
    }
}
