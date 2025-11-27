@extends('layouts.public')

@section('content')
<div class="min-h-screen flex bg-white font-poppins">
    
    {{-- BAGIAN KIRI: Branding Simple & Clean --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-orange-600 to-orange-500 relative items-center justify-center">
        {{-- Pattern titik-titik halus --}}
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        
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
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-600 transition-colors group no-underline">
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
                            <a class="text-xs font-bold text-orange-600 hover:text-orange-700 hover:underline no-underline" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" 
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('password') border-red-500 bg-red-50 @enderror" 
                        name="password" required autocomplete="current-password"
                        placeholder="Masukkan kata sandi">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center ml-3">
                    <input class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500 accent-orange-600 cursor-pointer" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm text-gray-600 cursor-pointer select-none" for="remember">
                        Ingat saya
                    </label>
                </div>

                {{-- Tombol Login (Rounded Full / Pill Shape) --}}
              <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-bold !rounded-full shadow-lg shadow-orange-200 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-3 mt-4 border-0 outline-none focus:outline-none">
                    <span>Masuk Sekarang</span>
                    <i class="bi bi-arrow-right text-lg"></i>
                </button>

                {{-- Register Link --}}
                <div class="text-center pt-6">
                    <p class="text-sm text-gray-500">
                        Belum memiliki akun? 
                        <a href="{{ route('register') }}" class="font-bold text-orange-600 hover:text-orange-800 transition-colors no-underline hover:underline">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection