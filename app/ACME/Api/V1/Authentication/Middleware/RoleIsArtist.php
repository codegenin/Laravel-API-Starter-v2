<?php

namespace App\ACME\Api\V1\Authentication\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleIsArtist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)
                ->guest() OR Auth::user()->role != 'artist') {
            
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ], 403);
            
        }
        
        return $next($request);
    }
}
