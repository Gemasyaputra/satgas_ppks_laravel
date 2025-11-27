<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounselingSchedule;
use App\Models\User;
use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CounselingScheduleController extends Controller
{
    public function index()
    {
        $schedules = CounselingSchedule::with('user', 'counselor')->latest()->paginate(10);
        $students = User::where('role', 'student')->where('is_active', true)->orderBy('name')->get();
        $counselors = Counselor::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.schedules.index', compact('schedules', 'students', 'counselors'));
    }

    public function store(Request $request)
    {
        $this->validateSchedule($request);

        CounselingSchedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, CounselingSchedule $schedule)
    {
        $this->validateSchedule($request);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(CounselingSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    // Aksi kustom untuk update status
    public function updateStatus(Request $request, CounselingSchedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:completed,cancelled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $schedule->update(['status' => $request->status]);

        return redirect()->route('admin.schedules.index')->with('success', 'Status jadwal berhasil diubah.');
    }

    // Helper validasi
    private function validateSchedule(Request $request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            // 'counselor_id' => 'required|exists:counselors,id',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|string',
            'topic' => 'nullable|string|max:255',
        ]);
    }
}
