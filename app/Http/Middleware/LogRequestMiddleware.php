<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
    
    public function terminate($request, $response)
    {
        if ($request->has('password')) {
            $request->merge([
                'password' => '********'
            ]);
        }
    
        Log::debug('APP.REQUEST', [
            'Method'     => $request->method(),
            'Route '     => $request->capture()
                ->getUri(),
            'Request'    => json_encode($request->all()),
            'User-Agent' => $request->server('HTTP_USER_AGENT'),
            //'response' => $response
            //'Method' => $request->route()->getActionName(),
        ]);
    }
}
