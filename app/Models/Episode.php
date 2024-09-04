<?php
// app/Models/Episode.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['video', 'episode', 'anime_id'];

    // Relationship dengan model Anime
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
