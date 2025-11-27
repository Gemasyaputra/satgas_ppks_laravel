@php
    // DATA (Tetap sama)
    $achievements = [
        [
            'number' => '24/7',
            'label' => 'Hotline Siaga',
            'icon' => 'bi-telephone-inbound-fill',
            'desc' => 'Selalu ada saat butuh',
        ],
        [
            'number' => '100%',
            'label' => 'Privasi Terjamin',
            'icon' => 'bi-file-lock2-fill',
            'desc' => 'Identitas aman terjaga',
        ],
        ['number' => 'Gratis', 'label' => 'Biaya Layanan', 'icon' => 'bi-heart-fill', 'desc' => 'Tanpa pungutan biaya'],
        ['number' => 'Solid', 'label' => 'Tim Satgas', 'icon' => 'bi-people-fill', 'desc' => 'Dosen & Mahasiswa'],
    ];

    $values = [
        'Profesionalisme dalam setiap penanganan kasus',
        'Jaminan kerahasiaan identitas pelapor 100%',
        'Pendekatan yang berpihak pada korban',
        'Akses mudah bagi seluruh civitas akademika',
        'Kolaborasi aktif antara Dosen dan Mahasiswa',
    ];
@endphp

<section id="tentang" class="bg-white py-16 relative overflow-hidden">

    {{-- Dekorasi Background (Lebih Tipis) --}}
    <div
        class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 bg-orange-50 rounded-full blur-3xl opacity-40 pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 bg-amber-50 rounded-full blur-3xl opacity-40 pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        {{-- Grid Logo + Content --}}
        {{-- PERUBAHAN: Gap dikurangi jadi gap-8 md:gap-12 --}}
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-12">

            {{-- Logo di Kiri --}}
            <div class="flex justify-center lg:justify-center order-2 lg:order-1">
                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-orange-200 to-amber-200 rounded-full blur-2xl opacity-30 group-hover:opacity-50 transition-opacity duration-500">
                    </div>

                    {{-- PERUBAHAN: Ukuran container logo diperkecil (w-64 / w-80) agar lebih pas --}}
                    <div
                        class="relative w-64 h-64 lg:w-80 lg:h-80 p-6 bg-white/40 backdrop-blur-sm rounded-full border border-white/60 shadow-lg flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas PPKPT"
                            class="w-full h-full object-contain filter drop-shadow-md transform transition-transform duration-500 group-hover:scale-105">
                    </div>
                </div>
            </div>

            {{-- Teks Konten di Kanan --}}
            {{-- PERUBAHAN: Space antar elemen dikurangi jadi space-y-6 --}}
            <div class="space-y-6 order-1 lg:order-2">
                <div>
                    <div
                        class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-3 py-1 rounded-full mb-4 shadow-sm">
                        <i class="bi bi-shield-fill-check text-xs"></i>
                        <span class="text-[10px] md:text-xs font-bold uppercase tracking-wide">Tentang Satgas
                            PPKPT</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3 leading-tight">
                        Melindungi & Mendukung <br>
                        <span class="text-orange-600">Mahasiswa Politeknik Negeri Padang</span>
                    </h2>
                    <div class="h-1 w-16 bg-orange-500 rounded-full"></div>
                </div>

                <div class="space-y-4 text-base lg:text-lg text-gray-600 leading-relaxed">
                    <p>
                        <strong class="text-gray-900">Satgas PPKPT</strong> adalah garda terdepan di lingkungan
                        Politeknik Negeri Padang yang berdedikasi untuk menciptakan ruang aman, bebas dari kekerasan
                        seksual, dan mendukung kesehatan mental seluruh civitas akademika.
                    </p>

                    {{-- Quote Box lebih compact (p-4) --}}
                    <div class="p-4 bg-orange-50 rounded-xl border-l-4 border-orange-500 shadow-sm">
                        <p class="text-sm text-orange-900 italic">
                            "Kami menggabungkan perspektif mahasiswa dan pengalaman tenaga pendidik untuk menghadirkan
                            layanan yang empatik, responsif, dan profesional."
                        </p>
                    </div>

                    {{-- List lebih rapat (space-y-2) --}}
                    <ul class="space-y-2 mt-2">
                        @foreach ($values as $value)
                            <li class="flex items-start gap-2.5">
                                <i class="bi bi-check-circle-fill text-orange-500 mt-1 flex-shrink-0 text-sm"></i>
                                <span class="text-gray-700 text-base">{{ $value }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Stats / Highlights Section --}}
        {{-- Padding dikurangi jadi p-8 --}}
        <div
            class="bg-gradient-to-r from-orange-600 to-amber-500 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="relative z-10">
                <div class="text-center mb-8">
                    {{-- Pastikan pakai text-white --}}
                    <h3 class="text-xl md:text-2xl font-bold mb-1 text-white">Komitmen Layanan Kami</h3>

                    {{-- Subtitle pakai warna putih pudar (orange-100) biar ada hierarki --}}
                    <p class="text-orange-100 text-sm md:text-base">Dedikasi penuh untuk keamanan dan kenyamanan Anda
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($achievements as $achievement)
                        <div class="text-center group">
                            {{-- Icon diperkecil sedikit --}}
                            <div
                                class="w-12 h-12 md:w-14 md:h-14 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center mx-auto mb-3 transition-transform group-hover:scale-110 group-hover:rotate-3 shadow-lg">
                                <i class="{{ $achievement['icon'] }} text-2xl text-white"></i>
                            </div>
                            <div class="text-2xl font-bold mb-0.5">{{ $achievement['number'] }}</div>
                            <div class="text-xs font-bold text-orange-100 uppercase tracking-wider mb-0.5">
                                {{ $achievement['label'] }}</div>
                            <div class="text-[10px] text-orange-200">{{ $achievement['desc'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
