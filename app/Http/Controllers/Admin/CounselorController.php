<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Untuk validasi
use Illuminate\Support\Facades\Storage;

class CounselorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data konselor, urutkan dari yang terbaru, dan paginasi
        $counselors = Counselor::latest()->paginate(10);
        return view('admin.counselors.index', compact('counselors'));
    }

    /**
     * Show the form for creating a new resource.
     * (Kita menggunakan modal, jadi method ini bisa dikosongi)
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email',
            'phone' => 'required|string|max:20',
            'role' => 'required|in:Mahasiswa Satgas,Tenaga Pendidik',
            // 'specialization' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            'experience' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataPath = null;
        if ($request->hasFile('photo')) {
            // Simpan file di 'storage/app/public/counselor_photos'
            // dan $dataPath akan berisi 'counselor_photos/namafile.jpg'
            $dataPath = $request->file('photo')->store('counselor_photos', 'public');
        }

        // Buat data konselor baru
        Counselor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            // 'specialization' => $request->specialization,
            // 'description' => $request->description,
            'experience' => $request->experience,
            'photo_url' => $dataPath,
            'is_active' => $request->has('is_active'), // Checkbox
        ]);

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Konselor baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     * (Tidak kita gunakan saat ini)
     */
    public function show(Counselor $counselor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * (Kita menggunakan modal, jadi method ini bisa dikosongi)
     */
    public function edit(Counselor $counselor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Counselor $counselor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email,' . $counselor->id, // Abaikan email saat ini
            'phone' => 'required|string|max:20',
            'role' => 'required|in:Mahasiswa Satgas,Tenaga Pendidik',
            // 'specialization' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            'experience' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataPath = $counselor->photo_url; // Simpan path lama
        if ($request->hasFile('photo')) {
            // 1. Hapus file lama jika ada
            if ($counselor->photo_url) {
                Storage::disk('public')->delete($counselor->photo_url);
            }
            // 2. Simpan file baru
            $dataPath = $request->file('photo')->store('counselor_photos', 'public');
        }

        // Update data konselor
        $counselor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            // 'specialization' => $request->specialization,
            // 'description' => $request->description,
            'experience' => $request->experience,
            'photo_url' => $dataPath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Data konselor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Counselor $counselor)
    {
        if ($counselor->photo_url) {
            Storage::disk('public')->delete($counselor->photo_url);
        }
        
        $counselor->delete();

        return redirect()->route('admin.counselors.index')
                         ->with('success', 'Data konselor berhasil dihapus.');
    
    }
}
