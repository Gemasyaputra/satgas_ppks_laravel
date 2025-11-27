<section id="beranda" class="relative bg-gradient-to-br from-orange-50 via-orange-100 to-amber-50 min-h-screen flex items-center overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-20 w-32 h-32 bg-orange-500 rounded-full blur-xl"></div>
        <div class="absolute bottom-40 right-20 w-48 h-48 bg-amber-500 rounded-full blur-xl"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-orange-300 rounded-full blur-2xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left Content --}}
            <div class="space-y-8 animate-fade-in">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full">
                        <i class="bi bi-shield-fill-check w-4 h-4"></i>
                        <span class="text-sm">Perlindungan & Konseling Mahasiswa</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl text-gray-800 leading-tight">
                        <span class="text-5 xl lg:text-6xl font-extrabold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                            SATGAS PPKPT
                        </span>
                        <br>
                        <span class="text-3xl lg:text-4xl text-gray-700">
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
                <div class="grid grid-cols-3 gap-6 py-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi bi-people-fill text-orange-600 text-2xl"></i>
                        </div>
                        <div class="text-2xl text-orange-600">24/7</div>
                        <div class="text-sm text-gray-600">Layanan Darurat</div>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi bi-heart-fill text-orange-600 text-2xl"></i>
                        </div>
                        <div class="text-2xl text-orange-600">100%</div>
                        <div class="text-sm text-gray-600">Kerahasiaan</div>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <i class="bi bi-shield-lock-fill text-orange-600 text-2xl"></i>
                        </div>
                        <div class="text-2xl text-orange-600">Pro</div>
                        <div class="text-sm text-gray-600">Tim Ahli</div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="#layanan"
                       class="decoration-none no-underline !no-underline bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        Jelajahi Layanan
                    </a>
                    <a href="#kontak"
                       class="decoration-none no-underline !no-underline border border-orange-400 text-orange-700 text-sm font-semibold px-5 py-2.5 rounded-full bg-white hover:bg-orange-50 transition-all duration-300 transform hover:scale-105">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            {{-- Right Content - Logo --}}
            <div class="flex justify-center lg:justify-end">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full blur-3xl opacity-20 scale-110"></div>
                    <div class="relative w-80 h-80 lg:w-96 lg:h-96 p-4 hover:scale-105 transition-transform duration-500">
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
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="bi bi-chevron-down text-orange-600 text-2xl"></i>
        </div>
    </div>
</section>
