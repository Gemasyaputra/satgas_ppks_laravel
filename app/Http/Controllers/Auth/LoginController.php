<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // <--- Jangan lupa import ini

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tentukan tujuan redirect setelah login berdasarkan ROLE user.
     */
    public function redirectTo()
    {
        $role = Auth::user()->role; 

        // 1. Jika Admin -> Ke Dashboard Admin
        if ($role == 'admin') {
            return route('admin.dashboard');
        } 
        
        // 2. Jika User Lain (Mahasiswa/Dosen/Umum) -> Ke Portal Mahasiswa
        // (Pastikan route 'student.dashboard' bisa diakses oleh mereka di Middleware)
        if (in_array($role, ['student', 'lecturer', 'public'])) {
            return route('student.dashboard');
        }

        // 3. Default (jika ada role tidak dikenal)
        return '/home';
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}