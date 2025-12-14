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
       // Izinkan Student, Lecturer, ATAU Public masuk ke area ini
    if (Auth::check() && in_array(Auth::user()->role, ['student', 'lecturer', 'public'])) {
        return $next($request);
    }

    return redirect('/home')->with('error', 'Akses ditolak.');
    }
}
