<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Jika mengakses prefix admin, arahkan ke login admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }
            // Default arahkan ke beranda (atau halaman login user jika ada)
            return route('home');
        }
    }
}