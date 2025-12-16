<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)        // Minimal 8 karakter
                    ->letters()         // Harus ada huruf
                    ->mixedCase()       // Harus ada Huruf Besar & Kecil
                    ->numbers()         // Harus ada Angka
                    ->symbols()         // Harus ada Simbol (@$!%*?&)
                    // ->uncompromised() // Opsional: Cek apakah password pernah bocor di internet (butuh koneksi internet)
            ],
            'role' => ['required', 'string', 'in:student,lecturer,public'],
            // 'nim' => ['required', 'string', 'max:255', 'unique:users'], // Validasi NIM
            // 'phone' => ['required', 'string', 'max:20'],
            // 'program' => ['required', 'string'],
            // 'department' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // Otomatis set role sebagai 'student'
            'is_active' => true, // Otomatis aktif
            
            // Data Mahasiswa
            // 'nim' => $data['nim'],
            // 'phone' => $data['phone'],
            // 'program' => $data['program'],
            // 'department' => $data['department'],
            
        ]);
    }
}
