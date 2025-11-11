<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolePPK
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'ppk') {
            return abort(403, 'Akses khusus untuk Tim PPK');
        }

        return $next($request);
    }
}
