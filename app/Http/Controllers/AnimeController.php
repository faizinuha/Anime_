<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Tayang_hari;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AnimeController extends Controller
{
    public function index()
    {
        // Memuat anime beserta kategori yang terkait
        $animes = Anime::with('category')->get();
        return view('animes.index', compact('animes'));
    }

    public function create()
    {
        $categories = Category::all();
        $tayangHaris  = Tayang_hari::all();
        return view('animes.create', compact('categories', 'tayangHaris'));
    }


    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mkv,webp|max:9999',
            'release_date' => 'required|date_format:d-m-Y',
            'Tayang_id' => 'required|exists:Tayang_hari,id', // Pastikan ini sesuai
            'description' => 'nullable|string',
            'status' => 'required|in:Ongoing,Completed,Upcoming',
            'studio' => 'nullable|string|max:255',
            'episodes' => 'nullable|integer',
            'trailer' => 'nullable|string|max:255',
            'type' => 'required|in:TV,Movie,OVA,ONA,Special',
            'duration' => 'nullable|integer',
            'synonyms' => 'nullable|string|max:255',
        ]);

        // Buat objek anime baru
        $anime = new Anime();

        // Konversi dan simpan tanggal
        $anime->release_date = Carbon::createFromFormat('d-m-Y', $request->release_date);

        $anime->fill($request->except('release_date')); // Jangan sertakan release_date di fill

        // Upload dan simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $anime->image = $imagePath;
        }

        // Upload dan simpan video jika ada
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            if ($videoPath) {
                $anime->video = $videoPath;
            } else {
                return redirect()->back()->with('error', 'Gagal mengupload video.');
            }
        }

        // Simpan data anime ke database
        $anime->save();

        // Redirect dengan pesan sukses
        return redirect()->route('anime.index')->with('success', 'Anime berhasil ditambahkan.');
    }


    public function edit($id)
    {
        // Mencari anime berdasarkan ID
        $anime = Anime::findOrFail($id);

        // Mendapatkan semua kategori untuk dropdown pada form edit
        $categories = Category::all();
        $tayangHaris = Tayang_hari::all();
        // Mengarahkan ke view edit dengan data anime dan categories
        return view('animes.edit', compact('anime', 'categories', 'tayangHaris'));
    }



    public function update(Request $request, Anime $anime)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:10240',
            'release_date' => 'required|date_format:d-m-Y',
            'Tayang_id' => 'required|exists:Tayang_hari,id',
            'description' => 'nullable|string',
            'status' => 'required|in:Ongoing,Completed,Upcoming',
            'studio' => 'nullable|string|max:255',
            'episodes' => 'nullable|integer',
            'trailer' => 'nullable|string|max:255',
            'type' => 'required|in:TV,Movie,OVA,ONA,Special',
            'duration' => 'nullable|integer',
            'synonyms' => 'nullable|string|max:255',
        ]);

        // Konversi dan simpan tanggal
        $anime->release_date = Carbon::createFromFormat('d-m-Y', $request->release_date);

        $anime->fill($request->except('release_date')); // Jangan sertakan release_date di fill

        if ($request->hasFile('image')) {
            if ($anime->image) {
                Storage::delete('public/' . $anime->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $anime->image = $imagePath;
        }

        if ($request->hasFile('video')) {
            if ($anime->video) {
                Storage::delete('public/' . $anime->video);
            }
            $videoPath = $request->file('video')->store('videos', 'public');
            $anime->video = $videoPath;
        }

        $anime->save();

        return redirect()->route('anime.index')->with('success', 'Anime berhasil diperbarui.');
    }


    // public function show(Anime $anime)
    // {
    //    return view('Anim.anime', compact('anime'));
    //    // dd($anime); 
    // }

    public function destroy($id)
    {
        $anime = Anime::find($id); // Mencari anime berdasarkan ID

        if (!$anime) {
            return redirect()->route('anime.index')->with('error', 'Anime tidak ditemukan.');
        }

        // Debugging: Tampilkan objek anime yang ditemukan
        // dd($anime);

        // Hapus gambar dari storage jika ada
        if ($anime->image) {
            Storage::delete('public/' . $anime->image);
        }

        // Hapus anime dari database
        $anime->delete();

        return redirect()->route('anime.index')->with('success', 'Anime berhasil dihapus.');
    }
}
