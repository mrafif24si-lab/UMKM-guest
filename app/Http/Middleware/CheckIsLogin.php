<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Jangan lupa import ini

class CheckIsLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika BELUM login, tendang ke halaman login
        if (!Auth::check()) {
            // Di modul 'auth.index', tapi route kamu namanya 'login'
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
}