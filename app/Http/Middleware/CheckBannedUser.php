<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBannedUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isBanned()) {
            Auth::logout();
            return redirect('/')->with('error', 'Your account has been banned.');
        }

        return $next($request);
    }
}

