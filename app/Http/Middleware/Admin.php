<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan ber-level 'admin'
        if (!Auth::check() || Auth::user()->level !== 'admin') {
            return redirect('/home')->with('error', 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}