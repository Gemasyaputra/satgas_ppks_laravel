<nav class="bg-white/95 backdrop-blur-sm px-6 py-4 shadow-lg border-b border-orange-100 sticky top-0 z-50 select-none">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex items-center gap-3">
            <img 
                src="{{ asset('images/logo.png') }}" 
                alt="Logo Satgas PPKS Politeknik Negeri Padang"
                class="w-14 h-14 object-contain filter drop-shadow-md">
            <div class="flex flex-col">
                <span class="text-orange-600 font-semibold text-lg">Satgas PPKS</span>
                <span class="text-gray-500 text-xs">Politeknik Negeri Padang</span>
            </div>
        </div>

        {{-- Navigation Menu - Desktop --}}
        <div class="hidden md:flex items-center gap-8">
            @foreach(['beranda','layanan','artikel','tentang','kontak'] as $menu)
                <a href="#{{ $menu }}" 
                   class="relative group text-gray-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 focus:outline-none no-underline decoration-none"
                   style="color: #374151 !important; text-decoration: none !important; outline: none !important;">
                    {{ ucfirst($menu) }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></span>
                </a>
            @endforeach
        </div>

        {{-- Mobile Menu Button --}}
        <div class="md:hidden">
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" 
                    class="text-gray-700 focus:outline-none focus:ring-0 active:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- Login Button - Desktop --}}
        <a href="{{ route('login') }}" 
           class="hidden md:flex bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none no-underline decoration-none"
           style="text-decoration: none !important; outline: none !important;">
            Masuk
        </a>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="md:hidden hidden mt-4 pb-4 border-t border-orange-100">
        <div class="flex flex-col gap-4 pt-4">
            @foreach(['beranda','layanan','artikel','tentang','kontak'] as $menu)
                <a href="#{{ $menu }}" 
                   class="text-gray-700 hover:text-orange-500 transition-all duration-300 focus:outline-none no-underline decoration-none"
                   style="color: #374151 !important; text-decoration: none !important;">
                    {{ ucfirst($menu) }}
                </a>
            @endforeach
            <a href="{{ route('login') }}" 
               class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white w-full py-2 rounded-lg text-center transition-all duration-300 transform hover:scale-105 focus:outline-none no-underline decoration-none"
               style="text-decoration: none !important; outline: none !important;">
                Masuk
            </a>
        </div>
    </div>
</nav>
