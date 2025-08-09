<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
       if (Auth::check() && in_array(Auth::user()?->role?->name, ['super_admin', 'admin'])) {
    return $next($request);
}

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}