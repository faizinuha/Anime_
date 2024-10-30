<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['anime_id', 'user_id', 'content', 'parent_id'];
    public function user()
    {

        return $this->belongsTo(User::class);
    }
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
    // public function nobaranime(){
    //     return $this->belongsTo(NobarAnime::class);
    // }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
