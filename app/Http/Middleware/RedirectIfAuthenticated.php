<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        } elseif (Auth::guard('petugas')->check()) {
            return redirect('/petugas/dashboard');
        } elseif (Auth::guard('masyarakat')->check()) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}

