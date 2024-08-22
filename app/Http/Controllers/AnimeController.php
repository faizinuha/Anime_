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
        $animes = Anime::all();
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
            'status' => 'required',
            'type' => 'required',
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

    public function show($id)
    {
        $anime = Anime::findOrFail($id);
        return view('animes.show', compact('anime'));
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
            'release_date' => 'required|date_format:Y-m-d', // Validasi format tanggal
            'status' => 'required',
            'type' => 'required',
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
            $anime->video = $request->file('video')->store('videos', ['disk' => 'public']);
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
        $anime->delete();
        return redirect()->route('anime.index')->with('success', 'Anime deleted successfully.');
    }
}
