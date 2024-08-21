<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tayang_hari extends Model
{
    use HasFactory;

    protected $table = '_hari'; // Menunjukkan nama tabel yang benar

    protected $fillable = ['nama'];

    public function anime()
    {
        return $this->hasMany(Anime::class, 'Tayang_id');
    }
}
