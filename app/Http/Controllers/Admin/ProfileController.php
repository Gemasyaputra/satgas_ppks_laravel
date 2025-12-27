<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // <-- TAMBAHKAN INI

class ProfileController extends Controller
{
    // Menampilkan Halaman Profil Admin
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    // Update Data Diri Admin (Nama/Email)
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    // Update Password Admin (Khusus Login Manual)
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                // ATURAN PASSWORD BARU DISINI:
                Password::min(8)    // Minimal 8 karakter
                    ->letters()     // Harus ada huruf
                    ->numbers()     // Harus ada angka
                    ->mixedCase()   // Harus ada huruf Besar & Kecil
                    // ->symbols()  // (Opsional) Uncomment jika wajib pakai simbol (@$!%*#?&)
            ],
        ]);

        $user = Auth::user();

        // 1. Cek apakah password lama benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // 2. Update password baru
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diganti.');
    }
}