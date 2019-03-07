<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Check if current user is admin or not
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->has_role('admin')) { //if the user is admin then keep going
            return $next($request);
        }

        return redirect('/'); //not an admin, return to home
    }
}
