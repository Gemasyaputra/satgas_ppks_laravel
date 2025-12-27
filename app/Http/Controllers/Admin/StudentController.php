<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // Tambahkan ini untuk validasi unique yang lebih fleksibel

class StudentController extends Controller
{
    /**
     * Menampilkan semua pengguna (Admin & Student)
     */
    public function index()
    {
        // Ambil semua user KECUALI user yang sedang login (diri sendiri)
        $users = User::where('id', '!=', auth()->id())
                     ->latest()
                     ->paginate(10);
        
        return view('admin.students.index', compact('users'));
    }

    /**
     * Store (Simpan Data Baru)
     * Catatan: Saat ini default role masih 'student'. 
     * Jika ingin tambah admin, perlu tambah input select role di modal.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // NIM boleh kosong jika nantinya ada fitur tambah admin/dosen
            'nim' => 'nullable|string|unique:users,nim', 
            'phone' => 'nullable|string|max:20',
            'program' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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
            // Jika NIM diisi, anggap student. Jika tidak, bisa jadi umum/admin (sementara default student)
            'role' => 'student', 
            'password' => Hash::make($request->nim ?? 'password123'), // Default password jika NIM kosong
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Update Data
     */
    public function update(Request $request, User $student)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($student->id)],
            // NIM dijadikan nullable agar Admin (yg tidak punya NIM) bisa di-update
            'nim' => ['nullable', 'string', Rule::unique('users')->ignore($student->id)],
            'phone' => 'nullable|string|max:20',
            'program' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataPath = $student->photo_url;
        if ($request->hasFile('photo')) {
            if ($student->photo_url) {
                Storage::disk('public')->delete($student->photo_url);
            }
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
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus Data
     */
    public function destroy(User $student)
    {
        if ($student->photo_url) {
            Storage::disk('public')->delete($student->photo_url);
        }
        $student->delete();
        return redirect()->route('admin.students.index')
                         ->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * Toggle Status Aktif/Nonaktif
     */
    public function toggleStatus(User $student)
    {
        $student->update(['is_active' => !$student->is_active]);
        $status = $student->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.students.index')
            ->with('success', "Akun pengguna $status.");
    }
}