<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class Jadwal extends Model
{
    use HasFactory;

    Protected $fillable = ['anime_id', 'tanggal', 'waktu', 'keterangan'];

    public function anime() {
        
        $this->belongsTo(Anime::class);
    }
}
