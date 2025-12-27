<section id="kontak" class="bg-gradient-to-br from-gray-50 to-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-4 py-2 rounded-full mb-4 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill text-sm"></i>
                <span class="text-xs md:text-sm font-bold uppercase tracking-wide">Kontak Darurat</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Jika Anda membutuhkan bantuan segera atau ingin berkonsultasi, jangan ragu untuk menghubungi tim Satgas
                PPKPT melalui berbagai saluran berikut.
            </p>
        </div>

        {{-- Emergency Box (Hotline Utama) --}}
        <div
            class="bg-gradient-to-r from-red-600 to-red-500 rounded-2xl p-8 text-white mb-16 text-center shadow-xl relative overflow-hidden group">
            {{-- Dekorasi Background Blur --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-16 -mt-16 blur-3xl"></div>

            <div class="relative z-10">
                {{-- Icon --}}
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <i class="bi bi-telephone-inbound-fill text-3xl text-white animate-pulse"></i>
                </div>

                {{-- Judul (UBAH JADI PUTIH DISINI) --}}
                <h3 class="text-2xl md:text-3xl font-bold mb-2 text-white">Dalam Keadaan Darurat?</h3>

                <p class="text-red-100 mb-8 text-lg">Layanan hotline kami aktif untuk respon cepat tanggap.</p>

                {{-- Tombol --}}
                <a href="https://wa.me/6285182056839" target="_blank"
                    class="inline-flex items-center bg-white text-red-600 hover:bg-gray-50 font-bold px-8 py-3.5 rounded-full shadow-lg transition-transform transform hover:scale-105">
                    <i class="bi bi-whatsapp me-2 text-xl"></i> Hubungi Sekarang
                </a>
            </div>
        </div>
        {{-- Contact Methods Grid --}}
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            @php
                $methods = [
                    [
                        'icon' => 'bi-whatsapp',
                        'title' => 'Chat WhatsApp',
                        'primary' => '+62 851-8205-6839',
                        'secondary' => 'Respon Cepat',
                        'description' => 'Konsultasi via chat WA',
                        'link' => 'https://wa.me/6285182056839',
                        'theme' => [
                            'bg' => 'bg-green-50',
                            'icon' => 'text-green-600',
                            'btn' => 'from-green-500 to-green-600',
                        ],
                    ],
                    [
                        'icon' => 'bi-envelope-fill',
                        'title' => 'Email Resmi',
                        'primary' => 'satgasppkspnp@pnp.ac.id',
                        'secondary' => 'Kirim Laporan Detail',
                        'description' => 'Untuk pengaduan tertulis',
                        'link' => 'https://mail.google.com/mail/?view=cm&fs=1&to=satgasppkspnp@pnp.ac.id',
                        'theme' => [
                            'bg' => 'bg-blue-50',
                            'icon' => 'text-blue-600',
                            'btn' => 'from-blue-500 to-blue-600',
                        ],
                    ],
                    [
                        'icon' => 'bi-instagram',
                        'title' => 'Instagram',
                        'primary' => '@satgasppkspoltekpadang',
                        'secondary' => 'Info & Edukasi',
                        'description' => 'Update kegiatan terbaru',
                        'link' => 'https://www.instagram.com/satgasppkptpoltekpadang?igsh=ZHl1bWpvczVjazBu',
                        'theme' => [
                            'bg' => 'bg-pink-50',
                            'icon' => 'text-pink-600',
                            'btn' => 'from-pink-500 to-pink-600',
                        ],
                    ],
                ];
            @endphp

            @foreach ($methods as $method)
                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 mx-auto {{ $method['theme']['bg'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="bi {{ $method['icon'] }} {{ $method['theme']['icon'] }} text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $method['title'] }}</h4>
                    <p class="text-gray-500 mb-4 text-sm">{{ $method['description'] }}</p>

                    <a href="{{ $method['link'] }}" target="_blank"
                        class="block w-full bg-gradient-to-r {{ $method['theme']['btn'] }} text-white font-medium py-2.5 rounded-xl shadow-md hover:opacity-90 transition-opacity">
                        {{ $method['primary'] }}
                    </a>
                    <p class="mt-3 text-xs text-gray-400 font-medium uppercase tracking-wider">
                        {{ $method['secondary'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Office Info & Location --}}
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">

            {{-- Jam Layanan --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 h-full">
                <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                        <i class="bi bi-clock-history text-orange-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">Jam Operasional</h4>
                </div>

                @php
                    $officeHours = [
                        ['day' => 'Senin - Jumat', 'time' => '08:00 - 16:00 WIB', 'type' => 'Layanan Kantor'],
                        ['day' => 'Sabtu - Minggu', 'time' => 'Tutup', 'type' => 'Kantor Libur'],
                        [
                            'day' => 'Layanan Daring',
                            'time' => '24 Jam',
                            'type' => 'Hotline & Pelaporan Online',
                            'highlight' => true,
                        ],
                    ];
                @endphp

                <div class="space-y-4">
                    @foreach ($officeHours as $schedule)
                        <div
                            class="flex justify-between items-center p-4 rounded-xl {{ isset($schedule['highlight']) ? 'bg-orange-50 border border-orange-100' : 'bg-gray-50' }}">
                            <div>
                                <div class="font-bold text-gray-800">{{ $schedule['day'] }}</div>
                                <div class="text-xs text-gray-500">{{ $schedule['type'] }}</div>
                            </div>
                            <div
                                class="font-bold {{ isset($schedule['highlight']) ? 'text-orange-600' : 'text-gray-600' }}">
                                {{ $schedule['time'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Lokasi Kantor --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 h-full flex flex-col">
                <div class="flex items-center gap-4 mb-6 border-b border-gray-100 pb-4">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                        <i class="bi bi-geo-alt-fill text-orange-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">Lokasi Kantor</h4>
                </div>

                <div class="flex-grow space-y-4 text-gray-600">
                    <p class="font-medium text-lg text-gray-800">Politeknik Negeri Padang</p>
                    <div class="flex items-start gap-3">
                        <i class="bi bi-building text-orange-500 mt-1"></i>
                        <span>Ruang Satgas PPKPT</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="bi bi-pin-map-fill text-orange-500 mt-1"></i>
                        <span>Kampus Limau Manis, Kec. Pauh, Kota Padang, Sumatera Barat 25164</span>
                    </div>
                </div>

                <a href="https://maps.app.goo.gl/5UjQ18MyRELRkc6o7" target="_blank"
                    class="mt-6 w-full inline-flex justify-center items-center gap-2 bg-white border-2 border-orange-500 text-orange-600 hover:bg-orange-500 hover:text-white font-bold py-3 rounded-xl transition-all duration-300">
                    <i class="bi bi-map"></i> Lihat di Google Maps
                </a>
            </div>

        </div>
    </div>
</section>
