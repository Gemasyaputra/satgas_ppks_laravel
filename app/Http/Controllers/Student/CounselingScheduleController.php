<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CounselingSchedule;
use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // <-- Import Carbon

class CounselingScheduleController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $schedules = CounselingSchedule::where('user_id', $userId)
                                       ->with('counselor')
                                       ->get();
        
        $upcomingSchedules = $schedules->where('status', 'scheduled')
                                       ->sortBy('date');
        
        $pastSchedules = $schedules->whereIn('status', ['completed', 'cancelled'])
                                   ->sortByDesc('date');

        // Data untuk modal booking
        $counselors = Counselor::where('is_active', true)->orderBy('name')->get();

        return view('student.counseling.index', compact('upcomingSchedules', 'pastSchedules', 'counselors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'counselor_id' => 'required|exists:counselors,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'duration' => 'required|string',
            'topic' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        CounselingSchedule::create([
            'user_id' => Auth::id(), // Otomatis isi ID mahasiswa
            'counselor_id' => $request->counselor_id,
            'date' => $request->date,
            'time' => $request->time,
            'duration' => $request->duration,
            'topic' => $request->topic,
            'status' => 'scheduled',
        ]);

        return redirect()->route('student.counseling.index')->with('success', 'Booking konseling berhasil. Silakan tunggu konfirmasi.');
    }

    public function cancel(CounselingSchedule $schedule)
    {
        // Keamanan: Pastikan mahasiswa hanya bisa membatalkan jadwalnya sendiri
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }

        // Hanya boleh batal jika status masih 'scheduled'
        if ($schedule->status == 'scheduled') {
            $schedule->update(['status' => 'cancelled']);
            return redirect()->route('student.counseling.index')->with('success', 'Jadwal berhasil dibatalkan.');
        }

        return redirect()->route('student.counseling.index')->with('error', 'Gagal membatalkan jadwal.');
    }
}