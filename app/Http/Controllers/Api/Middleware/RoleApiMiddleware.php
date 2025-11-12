<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleApiMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Jika tidak login (token invalid)
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        // Jika role pengguna tidak sesuai dengan yang diizinkan
        if (!in_array(strtolower($user->role), array_map('strtolower', $roles))) {
            return response()->json([
                'message' => 'Forbidden - role tidak diizinkan untuk mengakses endpoint ini',
                'user_role' => $user->role,
                'allowed_roles' => $roles
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
