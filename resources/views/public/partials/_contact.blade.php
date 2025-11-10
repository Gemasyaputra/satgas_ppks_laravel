<section id="kontak" class="bg-gradient-to-br from-gray-50 to-white py-20">
  <div class="max-w-7xl mx-auto px-6">
    {{-- Header --}}
    <div class="text-center mb-16">
      <div class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-4 py-2 rounded-full mb-4">
        <i class="bi bi-exclamation-triangle-fill w-4 h-4"></i>
        <span class="text-sm">Kontak Darurat</span>
      </div>
      <h2 class="text-4xl text-gray-800 mb-4">Hubungi Kami</h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Jika Anda membutuhkan bantuan segera atau ingin berkonsultasi, jangan ragu untuk menghubungi tim Satgas PPKPT melalui berbagai cara berikut
      </p>
    </div>

    {{-- Emergency Box --}}
    <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white mb-12 text-center">
      <i class="bi bi-exclamation-triangle-fill w-8 h-8 mx-auto mb-3 text-4xl"></i>
      <h3 class="text-xl mb-2">Dalam Keadaan Darurat?</h3>
      <p class="text-red-100 mb-4 2xl">Segera hubungi hotline darurat kami</p>
      <a href="tel:080068036086" class="inline-block bg-white text-red-600 hover:bg-gray-100 px-8 py-3 rounded-lg">
        <i class="bi bi-telephone-fill me-2"></i> Hubungi Sekarang
      </a>
    </div>

    {{-- Contact Methods --}}
    <div class="grid md:grid-cols-3 gap-8 mb-16">
      @php
        $methods = [
          [
            'icon' => 'bi-telephone-fill',
            'title' => 'Hotline Darurat',
            'primary' => '0800-123-456',
            'secondary' => '080680360860',
            'description' => 'Tersedia 24/7 untuk situasi darurat',
            'bgColor' => 'bg-red-50',
            'iconColor' => 'text-red-600',
            'gradient' => 'from-red-500 to-red-600'
          ],
          [
            'icon' => 'bi-envelope-fill',
            'title' => 'Email Resmi',
            'primary' => 'satgas@pnp.ac.id',
            'secondary' => 'ppkpt.pnp@gmail.com',
            'description' => 'Untuk konsultasi dan pertanyaan umum',
            'bgColor' => 'bg-blue-50',
            'iconColor' => 'text-blue-600',
            'gradient' => 'from-blue-500 to-blue-600'
          ],
          [
            'icon' => 'bi-chat-dots-fill',
            'title' => 'Chat Online',
            'primary' => 'WhatsApp',
            'secondary' => '+62 812-3456-7890',
            'description' => 'Chat langsung dengan konselor',
            'bgColor' => 'bg-green-50',
            'iconColor' => 'text-green-600',
            'gradient' => 'from-green-500 to-green-600'
          ]
        ];
      @endphp

      @foreach($methods as $method)
      <div class="bg-white rounded-2xl bg-white ring-1 ring-gray-200 p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
        <div class="w-16 h-16 mx-auto {{ $method['bgColor'] }} rounded-2xl flex items-center justify-center mb-4">
          <i class="bi {{ $method['icon'] }} {{ $method['iconColor'] }} w-8 h-8 text-2xl"></i>
        </div>
        <h4 class="text-xl text-gray-800 mb-2">{{ $method['title'] }}</h4>
        <p class="text-gray-600 mb-2">{{ $method['description'] }}</p>
        <div class="inline-block bg-gradient-to-r {{ $method['gradient'] }} text-white px-4 py-2 rounded-lg mb-1">
          {{ $method['primary'] }}
        </div>
        <div class="text-gray-600 text-sm">{{ $method['secondary'] }}</div>
      </div>
      @endforeach
    </div>

    {{-- Office Info --}}
    <div class="grid lg:grid-cols-2 gap-12">
      {{-- Jam Layanan --}}
      <div class="bg-white rounded-2xl bg-white ring-1 ring-gray-200 p-6">
        <div class="flex items-center gap-2 mb-4">
          <i class="bi bi-clock text-orange-600 w-6 h-9 text-2xl"></i>
          <h4 class="text-xl text-gray-800">Jam Layanan</h4>
        </div>
        @php
          $officeHours = [
            ['day' => 'Senin - Jumat', 'time' => '08:00 - 16:00 WIB', 'type' => 'Layanan Reguler'],
            ['day' => 'Sabtu', 'time' => '09:00 - 12:00 WIB', 'type' => 'Konsultasi Khusus'],
            ['day' => '24/7', 'time' => 'Sepanjang Waktu', 'type' => 'Hotline Darurat']
          ];
        @endphp
        <div class="space-y-4">
          @foreach($officeHours as $schedule)
          <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
            <div>
              <div class="text-gray-800">{{ $schedule['day'] }}</div>
              <div class="text-sm text-gray-600">{{ $schedule['type'] }}</div>
            </div>
            <div class="text-orange-600">{{ $schedule['time'] }}</div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Lokasi Kantor --}}
      <div class="bg-white rounded-2xl bg-white ring-1 ring-gray-200 p-6">
        <div class="flex items-center gap-2 mb-4">
          <i class="bi bi-geo-alt-fill text-orange-600 w-6 h-9 text-2xl"></i>
          <h4 class="text-xl text-gray-800">Lokasi Kantor</h4>
        </div>
        <div class="space-y-3">
          <div>
            <div class="text-gray-800">Politeknik Negeri Padang</div>
            <div class="text-gray-600">Gedung Rektorat, Lantai 2</div>
            <div class="text-gray-600">Ruang Satgas PPKPT</div>
          </div>
          <div class="text-gray-600">
            Jl. Kampus Limau Manis, Padang, Sumatera Barat 25164
          </div>
          <a href="#" class="w-full inline-block bg-orange-500 hover:bg-orange-600 text-white text-center py-3 rounded-lg mt-2">
            <i class="bi bi-geo-alt-fill me-2"></i> Lihat di Maps
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
