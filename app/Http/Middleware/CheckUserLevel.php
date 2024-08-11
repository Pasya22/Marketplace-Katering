<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $level, $guard = null)
    {
        if (Auth::check() && Auth::user()->level === $level && Auth::guard($guard)->check()) {
            return $next($request);
        }

        // Redirect to a default page if the user does not have the right level
        return redirect()->route('login')->withErrors(['message' => 'Unauthorized access']);
    }
}
