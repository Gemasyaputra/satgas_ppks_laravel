@extends('layouts.public')

@section('content')
    <div class="min-h-screen flex bg-white font-poppins">

        {{-- BAGIAN KIRI: Enhanced Branding --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-orange-600 via-orange-500 to-amber-500 relative items-center justify-center overflow-hidden">

            {{-- Animated Background Shapes --}}
            <div class="absolute inset-0">
                {{-- Pattern titik-titik halus --}}
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 30px 30px;"></div>

                {{-- Decorative Circles --}}
                <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-amber-300/20 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-orange-400/15 rounded-full blur-2xl"></div>
            </div>

            <div class="relative z-10 text-center px-12 max-w-xl">

                {{-- Logo Container dengan Efek Glow --}}
                <div class="mb-12 relative">
                    {{-- Glow Effect Background --}}
                    {{-- <div class="absolute inset-0 bg-white/20 rounded-full blur-2xl scale-150 animate-pulse"></div> --}}

                    {{-- Logo dengan Background Lingkaran Putih --}}
                    <div
                        class="relative rounded-full p-2 shadow-2xl transform hover:scale-105 hover:rotate-3 transition-all duration-500 inline-block">
                        <img src="{{ asset('images/logo_.png') }}" alt="Logo Satgas" class="w-38 h-38 object-contain">
                    </div>
                </div>

                {{-- Teks Branding dengan Animasi --}}
                <div class="space-y-6">
                    <h1 class="text-6xl font-extrabold text-white mb-4 tracking-tight drop-shadow-2xl leading-tight">
                        Satgas PPKPT
                    </h1>

                    <div class="inline-block bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full">
                        <p class="text-white text-xl font-semibold">
                            Politeknik Negeri Padang
                        </p>
                    </div>

                    {{-- Tagline --}}
                    <p class="text-orange-50 text-lg font-light leading-relaxed opacity-90 mt-6 max-w-md mx-auto">
                        Bergabung bersama kami untuk menciptakan lingkungan kampus yang aman dan nyaman
                    </p>

                    {{-- Decorative Line --}}
                    <div class="flex items-center justify-center gap-3 mt-8">
                        <div class="w-12 h-1 bg-white/40 rounded-full"></div>
                        <div class="w-8 h-1 bg-white/60 rounded-full"></div>
                        <div class="w-4 h-1 bg-white/80 rounded-full"></div>
                    </div>
                </div>

                {{-- Benefits Section --}}
                <div class="mt-16 space-y-4">
                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4 transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-2xl text-white"></i>
                        </div>
                        <p class="text-white text-sm font-medium text-left">Akses mudah ke layanan Satgas</p>
                    </div>

                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4 transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-shield-check text-2xl text-white"></i>
                        </div>
                        <p class="text-white text-sm font-medium text-left">Keamanan data terjamin</p>
                    </div>

                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4 transform hover:scale-105 transition-all duration-300">
                        <div class="bg-white/20 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-lightning-charge-fill text-2xl text-white"></i>
                        </div>
                        <p class="text-white text-sm font-medium text-left">Proses pendaftaran cepat</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- BAGIAN KANAN: Form Register --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 md:p-16 lg:p-24 bg-white overflow-y-auto">

            {{-- Tombol Kembali --}}
            <div class="mb-8">
                <a href="/"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-orange-600 transition-colors group no-underline">
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
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Email</label>
                        <input id="email" type="email"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('email') border-red-500 bg-red-50 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="nama@gmail.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Daftar Sebagai</label>
                        <div class="col-md-6">
                            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror"
                                required>
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="student">Mahasiswa</option>
                                <option value="lecturer">Dosen / Tendik</option>
                                <option value="public">Masyarakat Umum</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Password</label>
                        <input id="password" type="password"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400 @error('password') border-red-500 bg-red-50 @enderror"
                            name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Confirm Password --}}
                    <div>
                        <label for="password-confirm" class="block text-sm font-bold text-gray-700 mb-2 ml-3">Konfirmasi
                            Password</label>
                        <input id="password-confirm" type="password"
                            class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-full focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition-all outline-none text-gray-900 placeholder-gray-400"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                    </div>

                    {{-- Tombol Register (Pill Shape) --}}
                    <button type="submit"
                        class="w-full py-4 px-6 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-bold !rounded-full shadow-lg shadow-orange-200 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-3 mt-6 border-0 outline-none focus:outline-none">
                        <span>Daftar Sekarang</span>
                        <i class="bi bi-arrow-right text-lg"></i>
                    </button>

                    {{-- Login Link --}}
                    <div class="text-center pt-6">
                        <p class="text-sm text-gray-500">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="font-bold text-orange-600 hover:text-orange-800 transition-colors no-underline hover:underline">
                                Masuk disini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
