<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            Log::info('User ID: ' . Auth::id());
            Log::info('User role: ' . Auth::user()->role);
            Log::info('Required role: ' . $role);
        }

        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'You do not have access to this section.');
    }
}
