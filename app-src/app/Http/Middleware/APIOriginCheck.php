<?php

namespace App\Http\Middleware;

use Closure;

class APIOriginCheck
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
        //TODO: Come back and actually tie this to a DB table of allowed domains...
        
        return $next($request);
    }
}
