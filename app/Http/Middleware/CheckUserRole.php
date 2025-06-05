<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  // Parameter ini akan menerima peran yang diizinkan (misal: 'admin', 'alumni')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            // Jika tidak login, arahkan ke halaman login
            // Gunakan route() helper untuk fleksibilitas
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $user = Auth::user();

        // 2. Cek apakah user memiliki properti 'role'. Jika tidak, ada masalah data user.
        if (!isset($user->role)) {
            // Bisa jadi user belum punya role, atau field 'role' tidak ada.
            // Arahkan ke dashboard atau berikan error.
            Auth::logout(); // Log out user untuk keamanan
            return redirect('/')->with('error', 'Data pengguna tidak lengkap. Silakan hubungi administrator.');
        }

        // 3. Cek apakah peran user ada di daftar peran yang diizinkan
        // in_array() akan memeriksa apakah nilai $user->role ada dalam array $roles
        if (!in_array($user->role, $roles)) {
            // Jika tidak memiliki peran yang diizinkan, berikan error 403 (Forbidden)
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Jika semua cek lolos, lanjutkan request
        return $next($request);
    }
}