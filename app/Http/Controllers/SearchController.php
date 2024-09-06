<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime; // Pastikan ini adalah model yang tepat

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $results = Anime::where('name', 'LIKE', "%{$query}%")
        ->orWhereHas('category', function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->get();

        return view('src.search-results', compact('results'));
    }
}
