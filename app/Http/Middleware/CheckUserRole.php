<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // check if user login
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }
        // fetch user detail
        $user = Auth::user();
        // compare role of current user vs role required to access route
        if ($user->role->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        // if condition false allow request to pass
        return $next($request);
    }
}
