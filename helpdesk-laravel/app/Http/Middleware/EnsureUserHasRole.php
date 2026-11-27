<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // belum login -> ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // sudah login tapi role tidak cocok -> 403
        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Kamu tidak punya izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}