@extends('layouts.public')

@section('content')
<div class="min-h-screen flex bg-white font-poppins">
    
    {{-- BAGIAN KIRI: Branding (Gradient Oranye) --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-orange-600 to-orange-500 relative items-center justify-center">
        {{-- Pattern Halus --}}
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        
        <div class="relative z-10 text-center px-12 max-w-lg">
            <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                <div class="w-48 h-48 bg-white rounded-full flex items-center justify-center mx-auto shadow-2xl border-4 border-white/20">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas" class="w-32 h-32 object-contain">
                </div>
            </div>
            <h1 class="text-5xl font-bold text-white mb-4 tracking-wide drop-shadow-md">Satgas PPKPT</h1>
            <p class="text-orange-50 text-xl font-light leading-relaxed opacity-90">
                Bergabung bersama kami untuk menciptakan lingkungan kampus yang aman.
            </p>
            <div class="mt-8 w-24 h-1.5 bg-white/30 mx-auto rounded-full"></div>
        </div>
    </div>

    {{-- BAGIAN KANAN: Form Register --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 md:p-16 lg:p-24 bg-white overflow-y-auto">
        
        {{-- Tombol Kembali --}}
        <div class="mb-8">
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-600 transition-colors group no-underline">
                <i class="bi bi-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Beranda
            </a>
        </div>

        <div class="max-w-md w-full mx-auto">
            
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru 🚀</h2>
                <p class="text-gray-500">Daftar sekarang untuk mengakses layanan.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Input Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Nama Lengkap</label>
                    <input id="name" type="text" 
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('name') border-red-500 bg-red-50 @enderror" 
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Nama lengkap Anda">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Email Institusi</label>
                    <input id="email" type="email" 
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('email') border-red-500 bg-red-50 @enderror" 
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="nama@gmail.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Password</label>
                    <input id="password" type="password" 
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('password') border-red-500 bg-red-50 @enderror" 
                        name="password" required autocomplete="new-password"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Confirm Password --}}
                <div>
                    <label for="password-confirm" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Konfirmasi Password</label>
                    <input id="password-confirm" type="password" 
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400" 
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Ulangi password">
                </div>

                {{-- Tombol Register (Pill Shape) --}}
                <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-bold !rounded-full shadow-lg shadow-orange-200 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-3 mt-6 border-0 outline-none focus:outline-none">
                    <span>Daftar Sekarang</span>
                    <i class="bi bi-arrow-right text-lg"></i>
                </button>

                {{-- Login Link --}}
                <div class="text-center pt-6">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-800 transition-colors no-underline hover:underline">
                            Masuk disini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection