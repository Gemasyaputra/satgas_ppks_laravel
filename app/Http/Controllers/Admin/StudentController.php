<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // <-- Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // <-- Import Hash
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil hanya user dengan role 'student'
        $students = User::where('role', 'student')->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nim' => 'required|string|unique:users,nim',
            'phone' => 'nullable|string|max:20',
            'program' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataPath = null;
        if ($request->hasFile('photo')) {
            $dataPath = $request->file('photo')->store('student_photos', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'phone' => $request->phone,
            'program' => $request->program,
            'department' => $request->department,
            'photo_url' => $dataPath,
            'is_active' => $request->has('is_active'),
            'role' => 'student', // Tetapkan role
            'password' => Hash::make($request->nim), // Password = NIM
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Mahasiswa baru berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student) // Laravel akan inject User
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'nim' => 'required|string|unique:users,nim,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'program' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataPath = $student->photo_url;
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($student->photo_url) {
                Storage::disk('public')->delete($student->photo_url);
            }
            // Simpan foto baru
            $dataPath = $request->file('photo')->store('student_photos', 'public');
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'phone' => $request->phone,
            'program' => $request->program,
            'department' => $request->department,
            'photo_url' => $dataPath,
            'is_active' => $request->has('is_active'),
            // Kita tidak update password di sini
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        if ($student->photo_url) {
            Storage::disk('public')->delete($student->photo_url);
        }
        $student->delete();
        return redirect()->route('admin.students.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * Toggle the active status of a student.
     */
    public function toggleStatus(User $student)
    {
        $student->update(['is_active' => !$student->is_active]);
        $status = $student->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.students.index')
            ->with('success', "Mahasiswa $status.");
    }
}
