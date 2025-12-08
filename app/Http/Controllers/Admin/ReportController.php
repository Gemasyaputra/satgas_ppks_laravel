<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportMessage; // <-- Import Model Chat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Auth
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Menampilkan semua laporan
     */
    public function index()
    {
        // 'with('user')' (Eager Loading) untuk mengambil data mahasiswa (pelapor)
        $reports = Report::with('user')->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Menampilkan detail laporan (Info + Chat)
     */
    public function show(Report $report)
    {
        // Load relasi user (pelapor) dan messages (beserta user pengirim pesan)
        $report->load('user', 'messages.user');
        return view('admin.reports.show', compact('report'));
    }

    /**
     * Update status dan catatan admin
     */
    public function update(Request $request, Report $report)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:100', // Validasi kategori baru
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $report->update([
            'category' => $request->category, // Simpan perubahan kategori
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menyimpan pesan chat baru dari admin
     */
    public function storeMessage(Request $request, Report $report)
    {
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
            'user_id' => Auth::id(), // Admin yang sedang login
            'message' => $request->message,
            'sender_role' => 'admin',
        ]);

        // (Opsional: Kirim notifikasi ke mahasiswa di sini)

        return redirect()->back()->with([
            'success' => 'Pesan terkirim',
            'active_tab' => 'chat'
        ]);
    }
}
