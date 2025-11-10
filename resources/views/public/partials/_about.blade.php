@php
$achievements = [
    ['number' => '500+', 'label' => 'Mahasiswa Terbantu', 'icon' => 'bi-people-fill'],
    ['number' => '24/7', 'label' => 'Layanan Tersedia', 'icon' => 'bi-shield-fill'],
    ['number' => '95%', 'label' => 'Tingkat Kepuasan', 'icon' => 'bi-award'],
    ['number' => '10+', 'label' => 'Profesional Ahli', 'icon' => 'bi-person-badge'],
];

$values = [
    "Profesionalisme dalam setiap layanan",
    "Kerahasiaan dan privasi terjamin",
    "Pendekatan holistik dan komprehensif",
    "Aksesibilitas untuk semua mahasiswa",
    "Kolaborasi dengan berbagai pihak"
];
@endphp

<section id="tentang" class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Grid Logo + Content --}}
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-16">
            
            {{-- Logo tetap di kiri --}}
            <div class="flex justify-center lg:justify-start">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-200 to-amber-200 rounded-full blur-3xl opacity-30"></div>
                    <div class="relative w-80 h-80 lg:w-96 lg:h-96 p-4">
                        <img 
                            src="{{ asset('images/logo.png') }}" 
                            alt="Logo Politeknik Negeri Padang Satgas PPKPT" 
                            class="w-full h-full object-contain filter drop-shadow-2xl"
                        >
                    </div>
                </div>
            </div>

            {{-- Content di kanan --}}
            <div class="space-y-8">
                <div>
                    <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full mb-4">
                        <i class="bi bi-shield-fill-check w-4 h-4"></i>
                        <span class="text-sm">Tentang Satgas PPKPT</span>
                    </div>
                    <h2 class="text-4xl text-gray-800 mb-6">
                        Melindungi & Mendukung Mahasiswa PNP
                    </h2>
                </div>

                <div class="space-y-6 text-lg text-gray-600 leading-relaxed">
                    <p>
                        <strong class="text-gray-800">Satgas PPKPT Politeknik Negeri Padang</strong> adalah tim khusus yang 
                        didedikasikan untuk mendukung mahasiswa dalam menjaga kesehatan mental sekaligus 
                        memastikan perlindungan hak-hak mereka di lingkungan kampus.
                    </p>

                    <p>
                        Tim kami terdiri dari <strong class="text-orange-600">mahasiswa terpilih yang menjadi anggota Satgas</strong> dan 
                        <strong class="text-orange-600"> tenaga pendidik dari Politeknik Negeri Padang</strong>, yang bekerja sama 
                        menyediakan layanan konseling, advokasi, pendampingan darurat, dan edukasi komprehensif untuk menciptakan 
                        lingkungan kampus yang aman, nyaman, dan mendukung perkembangan mahasiswa.
                    </p>

                    <div class="p-4 bg-orange-50 rounded-lg border border-orange-200">
                        <p class="text-sm text-orange-900">
                            <strong>Komposisi Tim:</strong> Satgas PPKPT dibentuk dari mahasiswa anggota satgas yang telah terlatih 
                            dan tenaga pendidik kampus yang berpengalaman, memastikan pendekatan yang seimbang antara perspektif 
                            sesama mahasiswa dan bimbingan profesional dari dosen.
                        </p>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-gray-800 text-lg">Komitmen Kami:</h4>
                        @foreach($values as $value)
                        <div class="flex items-center gap-3">
                            <i class="bi bi-check-circle w-5 h-5 text-orange-500 flex-shrink-0"></i>
                            <span class="text-gray-600">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Achievements --}}
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-8 text-white">
            <div class="text-center mb-8">
                <h3 class="text-2xl mb-2">Pencapaian Kami</h3>
                <p class="text-orange-100">Dedikasi kami dalam melayani mahasiswa PNP</p>
            </div>
            <div class="grid md:grid-cols-4 gap-6">
                @foreach($achievements as $achievement)
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl">
                        <i class="bi {{ $achievement['icon'] }} w-8 h-8 text-white"></i>
                    </div>
                    <div class="text-3xl mb-1">{{ $achievement['number'] }}</div>
                    <div class="text-orange-100">{{ $achievement['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
