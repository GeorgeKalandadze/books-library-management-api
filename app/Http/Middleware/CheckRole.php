<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string[]  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        foreach ($roles as $role) {
            if ($user && $user->role()->where('name', $role)->exists()) {
                return $next($request);
            }
        }

        return response()->json(['error' => 'You do not have permission to access this resource'], 403);
    }
}
