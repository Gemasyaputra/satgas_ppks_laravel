<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Import Rule
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        $user = Auth::user();
        return view('student.profile.index', compact('user'));
    }
    

    /**
     * Update informasi profil (nama, email, phone).
     */
    public function updateProfile(Request $request)
    {
        
        $user = Auth::user();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Pastikan email unik, abaikan user saat ini
            ],
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('student.profile.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->only('name', 'email', 'phone');
        
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($user->photo_url) {
                Storage::disk('public')->delete($user->photo_url);
            }
            // Simpan foto baru dan tambahkan ke data
            $data['photo_url'] = $request->file('photo')->store('student_photos', 'public');
        }

        $user->update($data);

        return redirect()->route('student.profile.index')
                         ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' akan cek 'password_confirmation'
        ]);

        // Cek apakah password saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            $validator->errors()->add('current_password', 'Password saat ini tidak sesuai.');
            return redirect()->route('student.profile.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('student.profile.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('student.profile.index')
                         ->with('success', 'Password berhasil diubah.');
    }
}
