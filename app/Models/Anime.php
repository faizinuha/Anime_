<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $dates = ['release_date', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'name';
    }
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
        'type',
        'duration',
        'synonyms'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
