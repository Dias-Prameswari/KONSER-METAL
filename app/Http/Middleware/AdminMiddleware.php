<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // tambahan auth


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user(); // mendapatkan user yang terautentikasi

        if (!$user) { // jika tidak ada user yang terautentikasi, redirect ke halaman login
            return redirect()->route('login');
        }

        if ($user->role !== 'admin') { // jika user bukan admin, logout dan redirect ke halaman login
            Auth::logout();

            $request->session()->invalidate(); // invalidasi session
            $request->session()->regenerateToken(); // regenerasi token CSRF

            return redirect()->route('login');
        }

        // jika user adalah admin, lanjutkan request
        return $next($request);
    }
}
