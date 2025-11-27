<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CounselingSchedule;
use App\Models\Counselor;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Statistik Utama
        $stats = [
            'students_count' => User::where('role', 'student')->count(),
            'counselors_count' => Counselor::count(),
            'reports_total' => Report::count(),
            'reports_pending' => Report::where('status', 'pending')->count(),
            'articles_count' => Article::count(),
            'schedules_upcoming' => CounselingSchedule::where('status', 'scheduled')->count(),
        ];

        // 2. Ambil 5 Laporan Terbaru (untuk tabel quick action)
        // Kita eager load 'user' agar tidak query berulang
        $recentReports = Report::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 3. Ambil 5 Jadwal Konseling Mendatang
        $upcomingSchedules = CounselingSchedule::with(['user', 'counselor'])
            ->where('status', 'scheduled')
            ->whereDate('date', '>=', now()) // Hanya jadwal hari ini ke depan
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReports', 'upcomingSchedules'));
    }
}