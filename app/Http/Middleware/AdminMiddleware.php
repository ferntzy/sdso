<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
  /**
   * Handle an incoming request.
   */
  public function handle($request, Closure $next)
  {
    // Check if the user is logged in AND is an admin
    if (Auth::check() && Auth::user()->account_role === 'admin') {
      return $next($request);
    }

    // Otherwise, redirect them (for example, to dashboard or home)
    return redirect('/dashboard')->with('error', 'Access denied. Admins only.');
  }
}
