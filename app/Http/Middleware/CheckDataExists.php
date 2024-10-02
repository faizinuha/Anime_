<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB; // Correct namespace for DB
use Illuminate\Support\Facades\Log; // Correct namespace for Log
use Illuminate\Support\Facades\Auth;

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
        try {
            // Test database connection
            DB::connection()->getPdo();
            Log::info('Database is connected.');
        } catch (\Exception $e) {
            Log::error('Database connection failed: ' . $e->getMessage());

            // Redirect to an error page or return a specific response
            return redirect()->route('errors.no_connection')
                ->with('error', 'Database connection failed.');
        }

        return $next($request); // Proceed to the next middleware or request
    }
}
