<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Parameter ...$roles memungkinkan kita memasukkan lebih dari satu role sekaligus.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil nama_role dari user yang sedang login
        $userRole = Auth::user()->role->nama_role;

        // Cek apakah role user ada di dalam daftar role yang diizinkan untuk rute ini
        if (in_array($userRole, $roles)) {
            return $next($request); // Izinkan masuk
        }

        // Jika tidak punya akses, tampilkan halaman error 403 (Forbidden)
        abort(403, 'Akses Ditolak. Anda tidak memiliki hak untuk membuka halaman ini.');
    }
}