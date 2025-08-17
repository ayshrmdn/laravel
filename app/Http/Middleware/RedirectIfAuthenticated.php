<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Default Laravel behavior: periksa masing-masing guard
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (auth()->guard($guard)->check()) {
                // Jika guard admin, arahkan ke dashboard admin
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
                // Default user (web)
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
