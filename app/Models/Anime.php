<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $dates = ['release_date'];

    protected $fillable = ['name', 'release_date', 'image', 'video', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
}
