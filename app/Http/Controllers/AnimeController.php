<?php
namespace App\Http\Controllers;

use App\Models\Anime;
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
    
        // Mengirim data 'animes' ke view
        return view('animes.index', compact('animes'));
    }
    

    public function create()
    {
        $categories = Category::all();
        return view('animes.create',compact('categories'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Validasi category_id
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // validasi video
            'release_date' => 'required|date',
        ]);
    
        $anime = new Anime();
        $anime->name = $request->name;
        $anime->category_id = $request->category_id; // Simpan category_id
        $anime->release_date = $request->release_date;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $anime->image = $imagePath;
        }
    
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $anime->video = $videoPath;
        }
    
        $anime->save();
    
        return redirect()->route('animes.index')->with('success', 'Anime berhasil ditambahkan.');
    }
    

    public function show(Anime $anime)
    {
        return view('animes.show', compact('anime'));
    }

       
    public function edit(Anime $anime)
    {
        $categories = Category::all();
        return view('animes.edit', compact('anime', 'categories'));
    }

  
    public function update(Request $request, Anime $anime)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Validasi category_id
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // validasi video
            'release_date' => 'required|date',
        ]);
    
        $anime->name = $request->name;
        $anime->category_id = $request->category_id; // Update category_id
        $anime->release_date = Carbon::createFromFormat('d-m-Y', $request->release_date)->format('Y-m-d');
    
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
    
        return redirect()->route('animes.index')->with('success', 'Anime berhasil diperbarui.');
    }


    public function destroy(Anime $anime)
    {
        if ($anime->image) {
            Storage::delete('public/' . $anime->image);
        }
        $anime->delete();
        return redirect()->route('animes.index')->with('success', 'Anime berhasil dihapus.');
    }
}
