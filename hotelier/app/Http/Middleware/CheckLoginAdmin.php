<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // chưa login
        if (!Auth::guard('admin')->check() && !in_array(
            Route::currentRouteName(),['admin.login', 'admin.handle-login'])) {
           

            return redirect()->route('admin.login');
        }

        // Check login vào admin
        if (Auth::guard('admin')->check() && in_array(
            Route::currentRouteName(),
            ['admin.login', 'admin.handle-login']
        )) {
           
            return redirect()->route('admin.dashboard');
        }

        return $next($request);

    }
}
