<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\CounselingSchedule;
use App\Models\Article;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard mahasiswa dengan data statistik.
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil semua data
        $myReports = Report::where('user_id', $userId)->get();
        $mySchedules = CounselingSchedule::where('user_id', $userId)->get();

        // 2. Hitung Statistik
        $stats = [
            'pending_reports' => $myReports->whereIn('status', ['pending', 'in_progress'])->count(),
            'upcoming_schedules' => $mySchedules->where('status', 'scheduled')->count(),
            'completed_schedules' => $mySchedules->where('status', 'completed')->count(),
        ];

        // 3. Ambil 3 Laporan Terbaru
        $recentReports = Report::where('user_id', $userId)
                                ->latest()
                                ->take(3)
                                ->get();

        // 4. Ambil 3 Jadwal Konseling Mendatang
        $upcomingCounseling = CounselingSchedule::with('counselor')
                                ->where('user_id', $userId)
                                ->where('status', 'scheduled')
                                ->orderBy('date', 'asc')
                                ->take(3)
                                ->get();
        
        // 5. Ambil 3 Artikel Terbaru (untuk info)
        $recentArticles = Article::latest('published_at')
                                ->take(3)
                                ->get();

        // 6. Kirim semua data ke view
        return view('student.dashboard', compact(
            'stats', 
            'recentReports', 
            'upcomingCounseling', 
            'recentArticles'
        ));
    }
}