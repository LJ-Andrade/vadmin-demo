<?php

namespace App\Http\Middleware;
use Closure;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'customer')
    {
        if(!auth()->guard($guard)->check()){
            return redirect('/tienda');
        }
        return $next($request);
    }
}
