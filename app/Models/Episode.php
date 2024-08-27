<?php
// app/Models/Episode.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'video_url', 'episode_number', 'anime_id'];

    // Relationship dengan model Anime
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
