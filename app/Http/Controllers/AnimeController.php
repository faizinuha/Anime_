<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnimeController extends Controller
{
    public function index()
    {
        // $animes = Anime::all();
        // $animes = Anime::with(['animeEpisodes' => function ($q) {
        //     $q->orderBy('episode', 'desc')->limit(1);
        // }])->get();

        $animes = Anime::with([
            'animeEpisodes' => function ($query) {
                $query->orderBy('episode', 'desc');
            }
        ])->get();
        // $animes = Anime::with('animeEpisodes')->get();

        // dd($animes);
        return view('animes.index', compact('animes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('animes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'release_date' => 'required|date',
            'status' => 'required|in:Ongoing,Completed,Upcoming,FINISHED', // Hanya tiga status yang diizinkan
            'type' => 'required|in:TV,Movie,OVA,ONA,Special',
            'category_id' => 'required|exists:categories,id'
        ]);

        $anime = new Anime($request->all());

        if ($request->hasFile('image')) {
            $anime->image = $request->file('image')->store('images', ['disk' => 'public']);
        }
        if ($request->hasFile('video')) {
            $anime->video = $request->file('video')->store('videos', ['disk' => 'public']);
        }
        if ($request->hasFile('trailer')) {
            $anime->trailer = $request->file('trailer')->store('trailers', ['disk' => 'public']);
        }

        $anime->save();

        return redirect()->route('anime.index')->with('success', 'Anime created successfully.');
    }

    public function show($nama) // jika mengambil id pakai $id jika mengambil nama pakai $name
    {
        // $anime = Anime::findOrFail($id);
        // $anime = Anime::with('comments')->findOrFail($id); //pakai ini jika menggunakan id
        $anime = Anime::where('name', $nama)->with('comments')->first(); //pakai ini jika menggunakan nama
        return view('Anim.anime', compact('anime'));
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        $categories = Category::all();
        return view('animes.edit', compact('anime', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'release_date' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Ongoing,Completed,Upcoming,FINISHED', // Hanya tiga status yang diizinkan
            'type' => 'required|in:TV,Movie,OVA,ONA,Special',
            'category_id' => 'required|exists:categories,id'
        ]);

        // Temukan anime yang akan diupdate
        $anime = Anime::findOrFail($id);

        // Mengisi data anime dengan input yang telah dikonversi
        $anime->fill($request->except('release_date'));
        $anime->release_date = $request->release_date;

        // Simpan file jika ada
        if ($request->hasFile('image')) {
            $anime->image = $request->file('image')->store('images', ['disk' => 'public']);
        }

        if ($request->hasFile('video')) {
            // Buat folder berdasarkan nama anime
            $animeFolder = 'videos/' . $anime->name;
            // Simpan video ke folder tersebut
            $videoPath = $request->file('video')->store($animeFolder, 'public');
            $anime->video = $videoPath; // Simpan path video di database
        }

        if ($request->hasFile('trailer')) {
            $anime->trailer = $request->file('trailer')->store('trailers', ['disk' => 'public']);
        }

        // Simpan data anime yang telah diperbarui
        $anime->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('anime.index')->with('success', 'Anime updated successfully.');
    }

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);

        // Hapus gambar jika ada
        if ($anime->image) {
            $imagePath = public_path('storage') . '/' . $anime->image;
            // dd($imagePath);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus video jika ada
        if ($anime->video) {
            $videoPath = public_path('videos') . '/' . $anime->video;
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        // Hapus data Anime dari database
        $anime->delete();

        return redirect()->route('anime.index')->with('success', 'Anime deleted successfully.');
    }
}
