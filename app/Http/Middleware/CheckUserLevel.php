<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    public function handle(Request $request, Closure $next, $level)
    {
        // Pastikan user login dan levelnya sesuai
        if (Auth::check() && Auth::user()->level == $level) {
            return $next($request);
        }

        // Redirect jika user tidak memiliki akses
        return redirect('/')->with('error', 'Anda tidak memiliki akses.');

        $user = Auth::user();

        // Mengecek level pengguna
        if ($level == 0) {
            // Jika kasir (level 0), batasi transaksi hanya milik mereka sendiri
            if ($request->route()->named('addtransaksi')) {
                $userId = Auth::id();
                // Filter transaksi berdasarkan user_id kasir
                // Atau kamu bisa menggunakan session untuk membatasi data transaksi
                session(['user_transactions' => true]);
            }
        }
    
        if ($user->level != $level) {
            // Jika level tidak sesuai, redirect atau beri respon error
            return redirect()->route('dashboard')->with('error', 'You do not have access to this page.');
        }
    
        return $next($request);
    }
}
