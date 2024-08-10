<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Anime;

class CheckDataExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Cek apakah data anime ada
        if (Anime::count() == 0) {
            return redirect()->route('login'); // Arahkan ke halaman login jika data tidak ada
        }

        return $next($request);
    }
}

