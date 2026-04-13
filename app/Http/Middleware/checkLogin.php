<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkLogin
{
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda Belum Login');
        }

        // 2. Jika ada parameter role (misal: Admin), cek apakah role user cocok
        if ($role && Auth::user()->role !== $role) {
            abort(403, 'Akses Terbatas: Halaman ini hanya untuk ' . $role);
        }

        return $next($request);
    }
}