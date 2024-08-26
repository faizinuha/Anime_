<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'anime_id' => 'required|exists:animes,id' // Pastikan anime_id benar
        ]);
    
        Comment::create([
            'content' => $request->content,
            'anime_id' => $request->anime_id,
            'user_id' => auth()->id(), 
        ]);
    
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Berhasil Hapus');
    }
}
