<?php

namespace App\Http\Middleware;

use Closure;
use App\Attributes\RoleAttributes;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = auth()->user();

            if ($user->role === RoleAttributes::ROOT) {
                return redirect()->route('dashboard.index');
            }

            return redirect()->route('home');
        }

        return $next($request);
    }
}
