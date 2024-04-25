<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next $roles
     */
    public function handle(Request $request, Closure $next,  ...$roles): Response
    {   
        // Check if the user role is allowed
        // dd($roles);
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // User role is not allowed, deny access
        abort(403, 'Unauthorized');
    }
}
