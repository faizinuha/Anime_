<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class BookmarksController extends Controller
{
  
public function store(Request $request)
{
    $request->validate([
        'anime_id' => 'required|exists:animes,id',
    ]);

    $user = Auth::user();

    // Cek apakah anime sudah ada di bookmark
    Log::info('Checking if already bookmarked');
    $alreadyBookmarked = Bookmark::where('user_id', $user->id)
        ->where('anime_id', $request->anime_id)
        ->exists();

    if ($alreadyBookmarked) {
        Log::info('Already bookmarked');
        return redirect()->back()->with('message', 'Anime sudah ada di bookmarks Anda.');
    }

    // Simpan bookmark
    Log::info('Saving bookmark');
    Bookmark::create([
        'user_id' => $user->id,
        'anime_id' => $request->anime_id,
    ]);

    return redirect()->back()->with('message', 'Anime berhasil ditambahkan ke bookmarks.');
}
    public function destroy($animeId)
    {
        $user = Auth::user();

        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('anime_id', $animeId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return redirect()->back()->with('message', 'Anime berhasil dihapus dari bookmarks.');
        }

        return redirect()->back()->with('message', 'Anime tidak ditemukan di bookmarks Anda.');
    }
}
