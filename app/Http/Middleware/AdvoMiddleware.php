<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvoMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = $request->user()?->role ?? session('jabatan');

        $normalizedUserRole = strtolower(trim((string) $userRole));
        $normalizedAllowedRoles = array_map(
            static fn (string $role): string => strtolower(trim($role)),
            $roles
        );

        if ($normalizedUserRole === '' || !in_array($normalizedUserRole, $normalizedAllowedRoles, true)) {
            abort(403, 'Kamu tidak punya akses ke halaman ini');
        }

        return $next($request);
    }
}
