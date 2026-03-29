<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permissionName): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Admin (Level 1) has all permissions
        if ($user->level === 1) {
            return $next($request);
        }

        if (!$user->hasPermission($permissionName)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
