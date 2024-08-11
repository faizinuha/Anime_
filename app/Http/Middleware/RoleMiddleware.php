<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
         // Periksa apakah pengguna terotentikasi dan memiliki peran yang sesuai
         if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect atau abort jika pengguna tidak memiliki peran yang sesuai
            return redirect('/'); // Ganti dengan rute yang sesuai
        }
        return $next($request);
    }
}
