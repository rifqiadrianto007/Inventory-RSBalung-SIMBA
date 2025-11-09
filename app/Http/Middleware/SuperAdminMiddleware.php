<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session('role') !== 'super_admin') {
            abort(403, 'Akses hanya untuk Super Admin');
        }

        return $next($request);
    }
}
