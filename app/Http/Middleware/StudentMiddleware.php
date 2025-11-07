<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'student') {
            return $next($request);
        }

        // Jika bukan mahasiswa, kembalikan ke halaman home
        return redirect('/home')->with('error', 'Anda harus login sebagai mahasiswa.');
    }
}
