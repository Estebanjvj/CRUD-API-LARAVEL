<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        //return $next($request);
        return $next($request)
            ->header('Content-Type','application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers','Content-Type, Authorization')//'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since')
            ->header('Access-Control-Allow-Credentials', true)
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Allow-Headers', '*');
    }
}
