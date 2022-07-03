<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } elseif (Auth::user()->type == 'admin') {
            return $next($request);
        } elseif (Auth::user()->type == 'moderator' && (Route::is('admin.index') || Route::is('admin.questions.*') || Route::is('admin.answers.*'))) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
