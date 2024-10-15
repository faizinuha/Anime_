<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['account_id']; 
    protected $table = 'profile';
    public function user()
    {
        return $this->belongsTo(User::class, 'account_id');
    }
}
