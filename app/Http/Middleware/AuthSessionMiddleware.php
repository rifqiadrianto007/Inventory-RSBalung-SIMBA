<?php

namespace App\Http\Middleware;

use Closure;

class AuthSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        // Jika session id_pengguna kosong → belum login
        if (!session('id_pengguna')) {
            return redirect('/login')->withErrors(['msg' => 'Silakan login terlebih dahulu']);
        }

        return $next($request);
    }
}
