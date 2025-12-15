<section id="beranda" class="relative bg-gradient-to-br from-orange-50 via-orange-100 to-amber-50 min-h-screen flex items-center overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-20 w-32 h-32 bg-orange-500 rounded-full blur-xl"></div>
        <div class="absolute bottom-40 right-20 w-48 h-48 bg-amber-500 rounded-full blur-xl"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-orange-300 rounded-full blur-2xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- KONTEN KIRI (Teks, Statistik, Tombol) --}}
            <div class="space-y-8 animate-fade-in">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full">
                        <i class="bi bi-shield-fill-check w-4 h-4"></i>
                        <span class="text-sm">Perlindungan & Konseling Mahasiswa</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl text-gray-800 leading-tight font-bold">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-amber-600">
                            SATGAS PPKPT
                        </span>
                        <br>
                        <span class="text-3xl lg:text-4xl text-gray-700 font-normal">
                            Politeknik Negeri Padang
                        </span>
                    </h1>
                </div>

                <p class="text-xl text-gray-600 leading-relaxed">
                    Sistem Informasi Pengaduan, Konseling, dan Perlindungan Hak Mahasiswa.
                    Tim kami yang terdiri dari mahasiswa anggota Satgas dan tenaga pendidik kampus
                    hadir untuk mendukung kesejahteraan mental dan melindungi hak setiap mahasiswa
                    dengan layanan profesional dan terpercaya.
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 py-6 border-y border-orange-200/50">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi bi-people-fill text-orange-600 text-2xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-orange-600">24/7</div>
                        <div class="text-sm text-gray-600">Darurat</div>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi bi-heart-fill text-orange-600 text-2xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-orange-600">100%</div>
                        <div class="text-sm text-gray-600">Rahasia</div>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi bi-shield-lock-fill text-orange-600 text-2xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-orange-600">Pro</div>
                        <div class="text-sm text-gray-600">Ahli</div>
                    </div>
                </div>

                {{-- === GAMBAR KHUSUS MOBILE (Disisipkan di sini) === --}}
                {{-- lg:hidden artinya: sembunyi saat layar besar (Laptop) --}}
                <div class="flex justify-center lg:hidden py-4">
                    <div class="relative w-64 h-64">
                         {{-- Efek Glow --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo Mobile"
                            class="relative w-full h-full object-contain drop-shadow-xl"
                        >
                    </div>
                </div>
                {{-- ================================================= --}}

                {{-- TOMBOL (Akan berada di bawah gambar pada Mobile) --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="#layanan"
                       class="text-center bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 no-underline">
                        Jelajahi Layanan
                    </a>
                    <a href="#kontak"
                       class="text-center border-2 border-orange-500 text-orange-600 hover:text-white hover:bg-orange-500 text-sm font-semibold px-6 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 no-underline">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            {{-- KONTEN KANAN - GAMBAR (Hanya Tampil di Desktop) --}}
            {{-- hidden lg:flex artinya: sembunyi di HP, tampil (flex) di Laptop --}}
            <div class="hidden lg:flex justify-center lg:justify-end">
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full blur-3xl opacity-20 group-hover:opacity-30 transition-opacity duration-500 scale-110"></div>
                    
                    <div class="relative w-80 h-80 lg:w-96 lg:h-96 p-4 transition-transform duration-500 hover:scale-105">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo Satgas PPKPT Politeknik Negeri Padang"
                            class="w-full h-full object-contain drop-shadow-2xl"
                        >
                    </div>
                </div>
            </div>
            
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce cursor-pointer">
            <a href="#layanan" class="text-orange-600 hover:text-orange-800">
                <i class="bi bi-chevron-down text-2xl"></i>
            </a>
        </div>
    </div>
</section>