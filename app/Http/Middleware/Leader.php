<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Leader
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
        if (Auth::check() && Auth::user()->roles == 'LEADER') {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->roles == 'ADMIN') {
            return redirect('/admin');
        } elseif (Auth::check() && Auth::user()->roles == 'MEMBER') {
            return redirect('/');
        }
    }
}
