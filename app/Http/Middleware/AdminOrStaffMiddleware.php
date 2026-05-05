<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrStaffMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!Auth::user()->canManageSubjectsPrograms()) {
            return redirect('/home')->with('error', 'Access denied. Insufficient privileges.');
        }

        return $next($request);
    }
}
