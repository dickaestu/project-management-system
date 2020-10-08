<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Member
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
        if (Auth::check() && Auth::user()->roles == 'MEMBER') {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->roles == 'ADMIN') {
            return redirect('/admin');
        }
    }
}
