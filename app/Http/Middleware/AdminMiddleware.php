<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    // 1. Check if user is logged in
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // 2. Define roles allowed to enter the admin area
    $allowedRoles = ['admin', 'manager'];

    // 3. Check if the current user's role is in the allowed list
    if (!in_array(Auth::user()->role, $allowedRoles)) {
        // If they are a 'user' or guest, throw 403
        abort(403, 'You do not have permission to access the admin panel.');
    }

    return $next($request);
}
}
