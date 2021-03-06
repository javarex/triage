<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckEstablishment
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
        if(Auth::check())
        {
            if (Auth::user()->role !== 1) {
                return redirect('/');
            }
            }else{
            return redirect('/');
        }
        return $next($request);
    }
}
