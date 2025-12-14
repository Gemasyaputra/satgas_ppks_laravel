<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // 1. Jika Admin -> Lempar ke Admin Dashboard
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Jika Mahasiswa/Dosen/Umum -> Lempar ke Portal Mahasiswa
        if (in_array($user->role, ['student', 'lecturer', 'public'])) {
            return redirect()->route('student.dashboard');
        }

        // Default (jika error)
        return view('home');
    }
}