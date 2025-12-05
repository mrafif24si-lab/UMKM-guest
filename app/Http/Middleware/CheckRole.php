<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * $roles akan menerima parameter dipisahkan koma, misal: "admin,warga"
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil role user yang sedang login
        $userRole = Auth::user()->role;

        // 3. Cek apakah role user ada di dalam daftar role yang diizinkan
        // (Fungsi in_array mengecek apakah $userRole ada di dalam array $roles)
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Jika role tidak cocok, tolak akses (403 Forbidden)
        return abort(403, 'Maaf, Anda tidak memiliki akses ke halaman ini.');
    }
}