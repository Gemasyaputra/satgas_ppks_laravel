<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Setelah password berhasil direset, arahkan user ke sini.
     * Kita ganti dari '/home' menjadi '/login' agar mereka login ulang dengan password baru,
     * ATAU langsung ke '/portal/dashboard' jika ingin auto-login.
     */
    protected $redirectTo = '/portal/dashboard'; 

    // Jika ingin setelah reset user harus login manual (lebih aman):
    // protected $redirectTo = '/login'; 
}