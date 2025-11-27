<nav class="bg-white/95 backdrop-blur-sm px-6 py-4 shadow-lg border-b border-orange-100 sticky top-0 z-50 select-none transition-all duration-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        
        {{-- 1. LOGO --}}
        <a href="{{ route('public.home') }}" class="flex items-center gap-3 text-decoration-none group">
            <img 
                src="{{ asset('images/logo.png') }}" 
                alt="Logo Satgas PPKPT"
                class="w-12 h-12 md:w-14 md:h-14 object-contain filter drop-shadow-sm group-hover:scale-105 transition-transform">
            <div class="flex flex-col">
                <span class="text-orange-600 font-bold text-lg leading-tight group-hover:text-orange-700 transition-colors">Satgas PPKPT</span>
                <span class="text-gray-500 text-[10px] md:text-xs tracking-wide">Politeknik Negeri Padang</span>
            </div>
        </a>

        {{-- 2. DESKTOP MENU --}}
        <div class="hidden md:flex items-center gap-8">
            @foreach(['beranda', 'layanan', 'artikel', 'kontak'] as $menu)
                {{-- Logika Link: Selalu arahkan ke route home + anchor section --}}
                <a href="{{ route('public.home') }}#{{ $menu }}" 
                   class="relative group text-gray-700 !no-underline hover:text-orange-600 font-medium transition-all duration-300 py-2">
                    {{ ucfirst($menu) }}
                    {{-- Garis bawah animasi saat hover --}}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
                </a>
            @endforeach
        </div>

        {{-- 3. DESKTOP BUTTONS --}}
        <div class="hidden md:flex items-center gap-3">
            {{-- Tombol Lapor --}}
            <a href="{{ route('student.reports.index') }}" 
               class="bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 flex items-center !no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Lapor Sekarang!
            </a>

            {{-- Logika Tombol Login / Dashboard --}}
            @auth
                <a href="{{ route('home') }}" 
                   class="bg-orange-100 text-orange-700 hover:bg-orange-200 font-semibold px-5 py-2.5 rounded-lg transition-all duration-300 !no-underline flex items-center gap-2">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 !no-underline">
                    Masuk
                </a>
            @endauth
        </div>

        {{-- 4. MOBILE TOGGLE --}}
        <div class="md:hidden">
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" 
                    class="text-gray-700 hover:text-orange-600 focus:outline-none p-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- 5. MOBILE MENU (Dropdown) --}}
    <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-orange-100 bg-white absolute left-0 right-0 px-6 pb-6 shadow-xl rounded-b-2xl top-full">
        <div class="flex flex-col gap-3">
            @foreach(['beranda', 'layanan', 'artikel', 'kontak'] as $menu)
                <a href="{{ route('public.home') }}#{{ $menu }}" 
                   class="text-gray-700 hover:text-orange-600 font-medium py-2 px-2 rounded-lg hover:bg-orange-50 transition-all !no-underline block"
                   onclick="document.getElementById('mobile-menu').classList.add('hidden')"> {{-- Tutup menu saat diklik --}}
                    {{ ucfirst($menu) }}
                </a>
            @endforeach
            
            <hr class="border-gray-100 my-2">

            @auth
                <a href="{{ route('home') }}" 
                   class="bg-orange-50 text-orange-700 font-bold py-3 px-4 rounded-xl text-center !no-underline border border-orange-200">
                    Ke Dashboard Saya
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="bg-orange-600 text-white font-bold py-3 px-4 rounded-xl text-center hover:bg-orange-700 transition-colors !no-underline shadow-sm">
                    Masuk Akun
                </a>
            @endauth

            <a href="{{ route('student.reports.index') }}" 
               class="bg-red-600 text-white font-bold py-3 px-4 rounded-xl text-center hover:bg-red-700 transition-colors !no-underline shadow-md flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Lapor Sekarang
            </a>
        </div>
    </div>
</nav>