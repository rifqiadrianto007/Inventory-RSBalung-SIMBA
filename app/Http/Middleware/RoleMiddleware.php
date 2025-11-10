<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!in_array(session('role'), $roles)) {
            abort(403, 'Akses ditolak untuk role Anda');
        }

        return $next($request);
    }
}
