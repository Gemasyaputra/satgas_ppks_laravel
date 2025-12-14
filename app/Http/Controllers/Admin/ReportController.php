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
        // Tambahkan 'messages' dengan kondisi khusus (unread)
        $reports = Report::with('user')
            ->withCount(['messages as unread_messages_count' => function ($query) {
                $query->where('sender_role', 'student')->where('is_read', false);
            }])
            ->latest()
            ->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Menampilkan detail laporan (Info + Chat)
     */
    public function show(Report $report)
    {
        // 1. Tandai pesan dari 'student' sebagai sudah dibaca (is_read = true)
        //    Kita update hanya pesan yang statusnya BELUM DIBACA (false)
        ReportMessage::where('report_id', $report->id)
            ->where('sender_role', 'student') // Hanya pesan dari mahasiswa
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // 2. Load relasi seperti biasa
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

        return redirect()->back()
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

    /**
     * Mengambil isi chat terbaru (untuk AJAX Polling)
     */
    public function fetchChat(Report $report)
    {
        // Pastikan relasi pesan ter-load
        $report->load('messages.user');

        // Kembalikan hanya potongan HTML chatnya saja
        return view('partials.chat_content', compact('report'));
    }
}
