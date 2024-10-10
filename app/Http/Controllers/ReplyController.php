<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function reply(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'anime_id' => 'required|exists:animes,id',
            'parent_id' => 'required|exists:comments,id',
        ]);

        Comment::create([
            'content' => $request->content,
            'anime_id' => $request->anime_id,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully!');
    }
}
