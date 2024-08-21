<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tayang_hari extends Model
{
    use HasFactory;

    protected $table = 'tayang_hari'; // Menunjukkan nama tabel yang benar

    protected $fillable = ['nama'];

    public function animes()
    {
        return $this->hasMany(Anime::class, 'Tayang_id');
    }
}
