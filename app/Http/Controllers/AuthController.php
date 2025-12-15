<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Mengambil data dari file .env
    private function config()
    {
        return [
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
        ];
    }

    // Fungsi Cerdas: Cek apakah perlu verifikasi SSL?
    // Jika APP_ENV di .env adalah 'local', SSL dimatikan (false).
    // Jika 'production', SSL dihidupkan (true).
    private function shouldVerifySsl()
    {
        return env('APP_ENV') === 'production';
    }

    // 1. Redirect User ke Google
    public function redirectToGoogle()
    {
        $config = $this->config();
        
        $params = [
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect_uri'],
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'online',
            'prompt' => 'select_account',
        ];

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params));
    }

    // 2. Handle Balikan dari Google
    public function handleGoogleCallback(Request $request)
    {
        // Cek error atau pembatalan
        if (!$request->has('code')) {
            return redirect('/login')->with('error', 'Login dibatalkan.');
        }

        $config = $this->config();
        $verifySsl = $this->shouldVerifySsl(); // Otomatis tentukan keamanan

        // A. Tukar "Code" dengan "Access Token"
        $response = Http::withOptions(['verify' => $verifySsl]) // <--- KUNCI KEAMANAN DISINI
            ->asForm()->post('https://oauth2.googleapis.com/token', [
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'code' => $request->input('code'),
                'redirect_uri' => $config['redirect_uri'],
                'grant_type' => 'authorization_code',
            ]);

        if ($response->failed()) {
            return redirect('/login')->with('error', 'Gagal terhubung ke Google.');
        }

        $accessToken = $response->json()['access_token'] ?? null;

        // B. Ambil Data User
        $googleUserResponse = Http::withOptions(['verify' => $verifySsl])
            ->withHeaders(['Authorization' => 'Bearer ' . $accessToken])
            ->get('https://www.googleapis.com/oauth2/v3/userinfo');

        if ($googleUserResponse->failed()) {
            return redirect('/login')->with('error', 'Gagal mengambil data user.');
        }
        
        $googleUser = $googleUserResponse->json();

        // C. Simpan ke Database
        $user = User::updateOrCreate(
            ['email' => $googleUser['email']],
            [
                'name' => $googleUser['name'],
                'google_id' => $googleUser['sub'],
                'password' => bcrypt(Str::random(16)) // Password random dummy
            ]
        );

        // D. Login
        Auth::login($user);

        return redirect('/portal/dashboard');
    }
}