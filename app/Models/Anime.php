<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $dates = ['release_date', 'aired_from', 'aired_to'];

    // Menambahkan semua kolom yang dapat diisi
    protected $fillable = [
        'name',
        'release_date',
        'image',
        'video',
        'category_id',
        'description',
        'status',
        'rating',
        'studio',
        'episodes',
        'trailer',
        'popularity',
        'type',
        'aired_from',
        'aired_to',
        'duration',
        'synonyms'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
