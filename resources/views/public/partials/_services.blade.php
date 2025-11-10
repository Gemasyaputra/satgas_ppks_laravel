<section id="layanan" class="bg-gradient-to-br from-gray-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full mb-4">
                <i class="bi bi-heart-fill w-4 h-4"></i>
                <span class="text-sm">Layanan Terpercaya</span>
            </div>
            <h2 class="text-4xl text-gray-800 mb-4">Layanan Satgas PPKPT</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami menyediakan layanan profesional untuk mendukung kesejahteraan dan melindungi hak-hak mahasiswa PNP.
            </p>
        </div>

        {{-- Service Cards --}}
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            @forelse($services as $service)
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center
                            @if($service->color == 'red') bg-red-50 text-red-600
                            @elseif($service->color == 'blue') bg-blue-50 text-blue-600
                            @elseif($service->color == 'green') bg-green-50 text-green-600
                            @else bg-gray-50 text-gray-600 @endif">
                    <i class="bi 
                        @if($service->icon == 'phone') bi-telephone-fill
                        @elseif($service->icon == 'help') bi-chat-quote-fill
                        @elseif($service->icon == 'shield') bi-shield-fill-check
                        @endif
                    w-8 h-8"></i>
                </div>
                <h4 class="text-xl text-gray-800 mb-2">{{ $service->title }}</h4>
                <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                            @if($service->color == 'red') bg-gradient-to-r from-red-500 to-red-600 text-white
                            @elseif($service->color == 'blue') bg-gradient-to-r from-blue-500 to-blue-600 text-white
                            @elseif($service->color == 'green') bg-gradient-to-r from-green-500 to-green-600 text-white
                            @else bg-gray-300 text-gray-800 @endif">
                    <i class="bi bi-telephone-fill w-4 h-4"></i>
                    <span class="text-sm">{{ $service->phone }}</span>
                </div>
            </div>
            @empty
            <div class="col-span-3">
                <p class="text-center text-gray-500">Layanan sedang dipersiapkan.</p>
            </div>

            @endforelse
        </div>

        {{-- Features --}}
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-8 text-white">
            <div class="text-center mb-8">
                <h3 class="text-2xl mb-2">Mengapa Memilih Layanan Kami?</h3>
                <p class="text-orange-100">Komitmen kami untuk memberikan layanan terbaik</p>
            </div>
            <div class="grid md:grid-cols-4 gap-6">
                @php
                    $features = [
                        ['icon' => 'bi-clock', 'title' => '24/7 Tersedia', 'desc' => 'Layanan darurat tersedia sepanjang waktu'],
                        ['icon' => 'bi-heart-fill', 'title' => 'Profesional', 'desc' => 'Tim ahli berpengalaman dan terlatih'],
                        ['icon' => 'bi-people-fill', 'title' => 'Terpercaya', 'desc' => 'Jutaan mahasiswa telah terbantu'],
                        ['icon' => 'bi-shield-fill-check', 'title' => 'Rahasia', 'desc' => 'Jaminan kerahasiaan 100%']
                    ];
                @endphp
                @foreach($features as $feature)
                <div class="text-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3 text-2xl">
                        <i class="{{ $feature['icon'] }} w-7 h-7 text-white"></i>
                    </div>
                    <h4 class="text-lg mb-1">{{ $feature['title'] }}</h4>
                    <p class="text-orange-100 text-sm">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
