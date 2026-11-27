<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAdminMiddleware
{
    /**
     * Handle an incoming API write request (session or HTTP Basic auth, admin only).
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() && $request->getUser() !== null) {
            Auth::once([
                'username' => $request->getUser(),
                'password' => (string) $request->getPassword(),
            ]);
        }

        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'message' => 'Unauthenticated. Silakan login terlebih dahulu.',
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Hanya admin yang memiliki akses tulis.',
            ], 403);
        }

        return $next($request);
    }
}
