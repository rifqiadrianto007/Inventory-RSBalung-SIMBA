<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleGudang
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'admin gudang umum') {
            return abort(403, 'Akses khusus Admin Gudang Umum');
        }

        return $next($request);
    }
}
