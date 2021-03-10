<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role == 'ADMIN') {
            return $next($request);
        }

        if (Auth::check()) {
            Auth::guard('web')->logout();
        }

        return redirect('/login')->withErrors(['error' => 'You are not an Administrator!']);
    }
}
