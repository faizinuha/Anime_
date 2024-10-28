<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NobarAnime extends Model
{
    use HasFactory;
    protected $fillable = ['anime_id', 'user_id', 'key_rom', 'tanggal_waktu', 'jumlah_peserta', 'status', 'deskripsi'];
 public function getRouteKeyName()
    {
        return 'name';
    }
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_nobars', 'nobar_id', 'user_id');
    }
    public function ketua()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
