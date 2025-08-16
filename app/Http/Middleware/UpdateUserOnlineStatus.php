<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUserOnlineStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            // Update user online status
            Auth::guard('web')->user()->update([
                'is_online' => true,
                'last_seen_at' => now()
            ]);
        }

        if (Auth::guard('admin')->check()) {
            // Update admin online status
            Auth::guard('admin')->user()->update([
                'is_online' => true,
                'last_seen_at' => now()
            ]);
        }

        return $next($request);
    }
}
