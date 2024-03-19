<?php




namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): mixed  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty(Auth::user())) {
            if (url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')) {
                return redirect()->route('auth#loginPage');
            }
            if (Auth::user()->role == 'user') {
                abort('404');
            }
        }
        return $next($request);
    }
}

