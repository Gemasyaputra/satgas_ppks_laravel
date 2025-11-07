<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan milik mahasiswa yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();
        
        $reports = Report::where('user_id', $userId)->latest()->paginate(10);
        
        $stats = [
            'total' => Report::where('user_id', $userId)->count(),
            'pending' => Report::where('user_id', $userId)->whereIn('status', ['pending', 'in_progress'])->count(),
            'resolved' => Report::where('user_id', $userId)->whereIn('status', ['resolved', 'rejected'])->count(),
        ];
        
        return view('student.reports.index', compact('reports', 'stats'));
    }

    /**
     * Menyimpan laporan baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Report::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'is_anonymous' => $request->has('is_anonymous'),
            'status' => 'pending', // Status awal
        ]);

        return redirect()->route('student.reports.index')
                         ->with('success', 'Laporan Anda berhasil dikirim.');
    }

    /**
     * Menampilkan detail laporan (dan chat).
     */
    public function show(Report $report)
    {
        // KEAMANAN: Pastikan mahasiswa hanya bisa melihat laporannya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $report->load('user', 'messages.user');
        return view('student.reports.show', compact('report'));
    }

    /**
     * Menyimpan balasan chat dari mahasiswa.
     */
    public function storeMessage(Request $request, Report $report)
    {
        // KEAMANAN: Pastikan mahasiswa hanya bisa membalas laporannya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        ReportMessage::create([
            'report_id' => $report->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'sender_role' => 'student',
        ]);

        return redirect()->back()->with('success', 'Pesan terkirim.');
    }
}