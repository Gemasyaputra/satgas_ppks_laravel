<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CounselingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CounselingScheduleController extends Controller
{
    /**
     * Menampilkan daftar jadwal konseling mahasiswa.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua jadwal milik user ini
        $schedules = CounselingSchedule::where('user_id', $userId)
                                       ->with('counselor') // Tetap load relasi counselor untuk jadwal yang sudah ada
                                       ->get();
        
        // Filter jadwal mendatang (scheduled / pending)
        $upcomingSchedules = $schedules->whereIn('status', ['scheduled', 'pending'])
                                       ->sortBy('date');
        
        // Filter jadwal lampau (completed / cancelled / rejected)
        $pastSchedules = $schedules->whereIn('status', ['completed', 'cancelled', 'rejected'])
                                   ->sortByDesc('date');

        // CATATAN: Variabel $counselors dihapus karena dropdown pilih konselor di modal sudah dihilangkan.

        return view('student.counseling.index', compact('upcomingSchedules', 'pastSchedules'));
    }

    /**
     * Menyimpan booking baru (Tanpa memilih Konselor).
     */
    public function store(Request $request)
    {
        // 1. Validasi (Hapus counselor_id dari sini)
        $validator = Validator::make($request->all(), [
            'date'     => 'required|date|after_or_equal:today',
            'time'     => 'required',
            'duration' => 'required|string',
            'topic'    => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // 2. Simpan ke Database
        CounselingSchedule::create([
            'user_id'      => Auth::id(),
            'counselor_id' => null, // Set NULL, karena nanti ditentukan oleh Satgas/Admin
            'date'         => $request->date,
            'time'         => $request->time,
            'duration'     => $request->duration,
            'topic'        => $request->topic,
            'status'       => 'pending', // Status awal 'pending' (Menunggu konfirmasi Satgas)
        ]);

        return redirect()->route('student.counseling.index')
                         ->with('success', 'Permintaan konseling terkirim. Satgas akan menentukan konselor untuk Anda.');
    }

    /**
     * Membatalkan jadwal konseling.
     */
    public function cancel(CounselingSchedule $schedule)
    {
        // Keamanan: Pastikan mahasiswa hanya bisa membatalkan jadwalnya sendiri
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }

        // Hanya boleh batal jika status masih 'scheduled' atau 'pending'
        if (in_array($schedule->status, ['scheduled', 'pending'])) {
            $schedule->update(['status' => 'cancelled']);
            return redirect()->route('student.counseling.index')
                             ->with('success', 'Jadwal berhasil dibatalkan.');
        }

        return redirect()->route('student.counseling.index')
                         ->with('error', 'Gagal membatalkan jadwal karena status sudah selesai atau ditolak.');
    }
}