<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleTeknis
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'teknis') {
            return abort(403, 'Akses khusus untuk Tim Teknis');
        }

        return $next($request);
    }
}
