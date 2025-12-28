<section id="layanan" class="bg-gradient-to-br from-gray-50 to-white py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- Header --}}
        <div class="text-center mb-10 md:mb-16">
            <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full mb-4">
                <i class="bi bi-heart-fill text-sm"></i>
                <span class="text-sm font-medium">Layanan Terpercaya</span>
            </div>
            {{-- Font size responsif: 3xl di HP, 4xl di Desktop --}}
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">Layanan Satgas PPKPT</h2>
            <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto">
                Kami menyediakan layanan profesional untuk mendukung kesejahteraan dan melindungi hak-hak mahasiswa PNP.
            </p>
        </div>

        {{-- Service Cards --}}
        {{-- Grid responsif: 1 kolom (HP), 2 kolom (Tablet), 3 kolom (Desktop) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-16">
            @forelse($services as $service)
                @php
                    // 1. LOGIKA WARNA (Background Icon & Tombol)
                    $colorMap = [
                        'red' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'btn' => 'from-red-500 to-red-600'],
                        'blue' => [
                            'bg' => 'bg-blue-50',
                            'text' => 'text-blue-600',
                            'btn' => 'from-blue-500 to-blue-600',
                        ],
                        'green' => [
                            'bg' => 'bg-green-50',
                            'text' => 'text-green-600',
                            'btn' => 'from-green-500 to-green-600',
                        ],
                        'orange' => [
                            'bg' => 'bg-orange-50',
                            'text' => 'text-orange-600',
                            'btn' => 'from-orange-500 to-orange-600',
                        ],
                    ];
                    $theme = $colorMap[$service->color] ?? [
                        'bg' => 'bg-gray-50',
                        'text' => 'text-gray-600',
                        'btn' => 'from-gray-400 to-gray-500',
                    ];

                    // 2. LOGIKA ICON (Kembali menggunakan Icon Font)
                    $iconMap = [
                        'phone' => 'bi-telephone-fill',
                        'telephone' => 'bi-telephone-fill',
                        'email' => 'bi-envelope-fill',
                        'envelope' => 'bi-envelope-fill',
                        'mail' => 'bi-envelope-fill',
                        'instagram' => 'bi-instagram',
                        'ig' => 'bi-instagram',
                        'chat' => 'bi-chat-dots-fill',
                        'help' => 'bi-question-circle-fill',
                        'shield' => 'bi-shield-fill-check',
                        'person' => 'bi-person-fill',
                    ];
                    $iconClass = $iconMap[$service->icon] ?? 'bi-question-circle-fill';

                    // 3. LOGIKA LINK & DISPLAY TEXT (Fitur Pintar)
                    $linkUrl = '#';
                    $linkIcon = 'bi-arrow-right';
                    $displayText = $service->phone;

                    if (in_array($service->icon, ['email', 'mail', 'envelope'])) {
                        // Email
                        $linkUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to=' . $service->phone;
                        $linkIcon = 'bi-envelope-fill';
                    } elseif (in_array($service->icon, ['instagram', 'ig'])) {
                        // Instagram (Fix Username)
                        $cleanInput = explode('?', $service->phone)[0];
                        $username = basename(str_replace('@', '', $cleanInput));

                        $linkUrl = 'https://instagram.com/' . $username;
                        $linkIcon = 'bi-instagram';
                        $displayText = '@' . $username;
                    } else {
                        // WhatsApp / Phone
                        $cleanPhone = preg_replace('/[^0-9]/', '', $service->phone);
                        if (substr($cleanPhone, 0, 2) == '08') {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                        $linkUrl = 'https://wa.me/' . $cleanPhone;
                        $linkIcon = 'bi-whatsapp';
                    }
                @endphp

                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group flex flex-col h-full border border-gray-100">

                    {{-- BAGIAN ATAS: ICON BESAR --}}
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-6 rounded-3xl flex items-center justify-center {{ $theme['bg'] }} {{ $theme['text'] }} group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <i class="bi {{ $iconClass }} text-3xl md:text-4xl"></i>
                    </div>

                    {{-- BAGIAN TENGAH: JUDUL & DESKRIPSI --}}
                    <div class="flex-grow">
                        <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-3">{{ $service->title }}</h4>
                        <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                            {{ $service->description }}
                        </p>
                    </div>

                    {{-- BAGIAN BAWAH: TOMBOL ACTION --}}
                    <div class="mt-auto">
                        <a href="{{ $linkUrl }}" target="_blank"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r {{ $theme['btn'] }} text-white hover:opacity-90 transition-all shadow-md group-hover:shadow-lg w-full no-underline hover:no-underline">
                            <i class="bi {{ $linkIcon }}"></i>
                            <span class="font-medium truncate text-sm md:text-base">{{ $displayText }}</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 py-12 text-center text-gray-400">
                    <i class="bi bi-inbox-fill text-4xl mb-2 block"></i>
                    <p>Layanan sedang dipersiapkan.</p>
                </div>
            @endforelse
        </div>

        {{-- Features --}}
        {{-- Padding disesuaikan: p-6 di HP, p-12 di Desktop --}}
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-6 md:p-12 text-white shadow-xl">

            <div class="text-center mb-8 md:mb-10">
                <h3 class="text-2xl md:text-3xl font-bold mb-2 text-white">Mengapa Memilih Layanan Kami?</h3>
                <p class="text-orange-100 text-base md:text-lg">Komitmen kami untuk memberikan layanan terbaik</p>
            </div>

            {{-- Grid Feature: 1 kolom (HP kecil), 2 kolom (HP besar/Tablet), 4 kolom (Desktop) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 md:gap-8">
                @php
                    $features = [
                        [
                            'icon' => 'bi-clock',
                            'title' => '24/7 Tersedia',
                            'desc' => 'Layanan darurat tersedia sepanjang waktu',
                        ],
                        [
                            'icon' => 'bi-heart-fill',
                            'title' => 'Profesional',
                            'desc' => 'Tim ahli berpengalaman dan terlatih',
                        ],
                        [
                            'icon' => 'bi-people-fill',
                            'title' => 'Terpercaya',
                            'desc' => 'Ribuan mahasiswa telah terbantu',
                        ],
                        ['icon' => 'bi-shield-fill-check', 'title' => 'Rahasia', 'desc' => 'Jaminan kerahasiaan 100%'],
                    ];
                @endphp
                @foreach ($features as $feature)
                    <div class="text-center group">
                        <div
                            class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 transition-transform group-hover:rotate-6">
                            <i class="{{ $feature['icon'] }} text-3xl text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold mb-2 text-white">{{ $feature['title'] }}</h4>
                        <p class="text-orange-100 text-sm leading-relaxed px-2">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>