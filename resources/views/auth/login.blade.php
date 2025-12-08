@extends('layouts.public')

@section('content')
    <div class="min-h-screen flex bg-white font-poppins">

        {{-- BAGIAN KIRI: Branding Simple & Clean --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-orange-600 to-orange-500 relative items-center justify-center">
            {{-- Pattern titik-titik halus --}}
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>

            <div class="relative z-10 text-center px-12 max-w-lg">

                {{-- Logo dengan Background Lingkaran Putih --}}
                <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('images/logo_.png') }}" alt="Logo Satgas" class="w-32 h-32 object-contain mx-auto">
                </div>

                {{-- Teks Branding --}}
                <h1 class="text-5xl font-bold text-white mb-4 tracking-wide drop-shadow-md">Satgas PPKPT</h1>
                <p class="text-orange-50 text-xl font-light leading-relaxed opacity-90">
                    Politeknik Negeri Padang
                </p>

                {{-- Garis pemanis simple --}}
                <div class="mt-8 w-24 h-1.5 bg-white/30 mx-auto rounded-full"></div>
            </div>
        </div>

        {{-- BAGIAN KANAN: Form Login --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 md:p-16 lg:p-24 bg-white">

            {{-- Tombol Kembali --}}
            <div class="mb-10">
                <a href="/"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-600 transition-colors group no-underline">
                    <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="max-w-md w-full mx-auto">

                {{-- Header Form --}}
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang! 👋</h2>
                    <p class="text-gray-500">Masuk untuk mengakses layanan Satgas.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Input Email (Rounded Full) --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Email</label>
                        <input id="email" type="email"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('email') border-red-500 bg-red-50 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="nama@pnp.ac.id">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Password (Rounded Full) --}}
                    <div>
                        <div class="flex justify-between items-center mb-2 ml-3 mr-1">
                            <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-orange-600 hover:text-orange-700 hover:underline no-underline"
                                    href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('password') border-red-500 bg-red-50 @enderror"
                            name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
                        @error('password')
                            <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center ml-3">
                        <input
                            class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500 accent-orange-600 cursor-pointer"
                            type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="ml-2 block text-sm text-gray-600 cursor-pointer select-none" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    {{-- Tombol Login (Rounded Full / Pill Shape) --}}
                    {{-- Tombol Login Utama --}}
                    <button type="submit"
                        class="w-full py-4 px-6 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-bold !rounded-full shadow-lg shadow-orange-200 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-3 mt-4 border-0 outline-none focus:outline-none">
                        <span>Masuk Sekarang</span>
                        <i class="bi bi-arrow-right text-lg"></i>
                    </button>

                    {{-- Divider / Pemisah --}}
                    <div class="relative flex py-5 items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-400 text-sm">atau masuk dengan</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    {{-- Tombol Google (Style: White Clean) --}}
                    <a href="{{ route('google.login') }}"
                        class="w-full py-3.5 px-6 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold rounded-full shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-3 no-underline group">

                        {{-- Icon Google Berwarna --}}
                        <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>

                        <span class="group-hover:text-gray-900 transition-colors">Google</span>
                    </a>
                    {{-- Register Link --}}
                    <div class="text-center pt-6">
                        <p class="text-sm text-gray-500">
                            Belum memiliki akun?
                            <a href="{{ route('register') }}"
                                class="font-bold text-orange-600 hover:text-orange-800 transition-colors no-underline hover:underline">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
