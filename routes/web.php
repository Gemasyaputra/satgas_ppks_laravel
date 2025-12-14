<?php

// routes/web.php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CounselorController;
use App\Http\Controllers\Student\ReportController as StudentReportController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\ArticleController as StudentArticleController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Admin\CounselingScheduleController as AdminScheduleController;
use App\Http\Controllers\Student\CounselingScheduleController as StudentScheduleController;

// --- RUTE PUBLIK ---
Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/artikel/{article}', [PublicController::class, 'showArticle'])->name('public.article.show');
Route::get('/artikel', [PublicController::class, 'articlesIndex'])->name('public.articles.index');


// --- RUTE AUTENTIKASI (Login, Register, Logout) ---
Auth::routes();

// --- RUTE REDIRECT SETELAH LOGIN ---
Route::get('/home', [HomeController::class, 'index'])->name('home');

// --- GRUP PANEL ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('counselors', CounselorController::class);
    Route::patch('students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggleStatus');
    Route::resource('students', StudentController::class);

    // Menampilkan list laporan
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    // Menampilkan detail laporan (Info + Chat)
    Route::get('reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    // Mengirim balasan chat
    Route::post('reports/{report}/message', [ReportController::class, 'storeMessage'])->name('reports.storeMessage');
    // Mengupdate status laporan (via modal)
    Route::put('reports/{report}', [ReportController::class, 'update'])->name('reports.update');
    Route::resource('articles', ArticleController::class);
    Route::patch('schedules/{schedule}/update-status', [AdminScheduleController::class, 'updateStatus'])->name('schedules.updateStatus');
    Route::resource('schedules', AdminScheduleController::class);
    Route::resource('services', ServiceController::class);

    Route::get('profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profil/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

// --- GRUP PANEL MAHASISWA ---
Route::middleware(['auth', 'student'])->prefix('mahasiswa')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('laporan', [StudentReportController::class, 'index'])->name('reports.index');
    Route::post('laporan', [StudentReportController::class, 'store'])->name('reports.store');
    Route::get('laporan/{report}', [StudentReportController::class, 'show'])->name('reports.show');
    Route::post('laporan/{report}/message', [StudentReportController::class, 'storeMessage'])->name('reports.storeMessage');
    Route::get('artikel', [StudentArticleController::class, 'index'])->name('articles.index');
    Route::get('artikel/{article}', [StudentArticleController::class, 'show'])->name('articles.show');
    Route::get('konseling', [StudentScheduleController::class, 'index'])->name('counseling.index');
    Route::post('konseling', [StudentScheduleController::class, 'store'])->name('counseling.store');
    Route::patch('konseling/{schedule}/cancel', [StudentScheduleController::class, 'cancel'])->name('counseling.cancel');
    Route::get('profil', [StudentProfileController::class, 'index'])->name('profile.index');
    Route::put('profil', [StudentProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profil/password', [StudentProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
