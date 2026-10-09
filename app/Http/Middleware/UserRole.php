<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $currentRole = auth()->user()->role;

        if (!in_array($currentRole, $roles)) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}