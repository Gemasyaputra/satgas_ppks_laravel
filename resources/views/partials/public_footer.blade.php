<footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
  {{-- Main Footer --}}
  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid md:grid-cols-4 gap-8">

      {{-- Logo & Description --}}
      <div class="space-y-4">
        <div class="flex items-center gap-3">
          <img 
            src="{{ asset('images/logo.png') }}" 
            alt="Logo Satgas PPKS"
            class="w-14 h-14 object-contain filter drop-shadow-md">
          <div>
            <div class="text-lg font-medium">Satgas PPKS</div>
            <div class="text-gray-400 text-sm">Politeknik Negeri Padang</div>
          </div>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed">
          Mendukung kesejahteraan mental dan melindungi hak mahasiswa 
          dengan layanan profesional dan terpercaya.
        </p>
      </div>

        {{-- Quick Links --}}
        <div>
        <h4 class="text-lg mb-4 font-medium"style="color: #9ca3af !important;">Navigasi</h4>
        <div class="space-y-2">
            @foreach(['beranda','layanan','artikel','tentang','kontak'] as $link)
            <a 
                href="#{{ $link }}" 
                class="block transition-all duration-300 text-sm"
                style="
                color: #9ca3af !important; /* abu-abu default */
                text-decoration: none !important; 
                outline: none !important;
                "
                onmouseover="this.style.color='#fb923c'" 
                onmouseout="this.style.color='#9ca3af'"
                onfocus="this.style.color='#fb923c'" 
                onblur="this.style.color='#9ca3af'"
            >
                {{ ucfirst($link) }}
            </a>
            @endforeach
        </div>
        </div>



      {{-- Services --}}
      <div>
        <h4 class="text-lg mb-4 font-medium" style="color: #9ca3af !important;">
         Layanan</h4>
        <div class="space-y-2 text-sm text-gray-400">
          <div>Konseling Online</div>
          <div>Hotline Darurat</div>
          <div>Perlindungan Hak</div>
          <div>Edukasi Mental Health</div>
        </div>
      </div>

      {{-- Contact Info --}}
      <div>
        <h4 class="text-lg mb-4 font-medium" style="color: #9ca3af !important;">Kontak</h4>
        <div class="space-y-3 text-sm text-gray-400">
          <div class="flex items-center gap-2">
            <i class="bi bi-telephone-fill text-orange-400"></i>
            <span>080680360860</span>
          </div>
          <div class="flex items-center gap-2">
            <i class="bi bi-envelope-fill text-orange-400"></i>
            <span>satgas@pnp.ac.id</span>
          </div>
          <div class="flex items-start gap-2">
            <i class="bi bi-geo-alt-fill text-orange-400 mt-0.5 flex-shrink-0"></i>
            <span>Politeknik Negeri Padang, Lt. 2, Ruang Satgas</span>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- Bottom Footer --}}
  <div class="border-t border-gray-700">
    <div class="max-w-7xl mx-auto px-6 py-6">
      <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-gray-400 text-sm text-center md:text-left">
          © 2025 Satgas PPKS Politeknik Negeri Padang. Semua Hak Dilindungi.
        </div>
        <div class="flex items-center gap-1 text-gray-400 text-sm">
          <span>Dibuat dengan</span>
          <i class="bi bi-heart-fill text-red-400"></i>
          <span>untuk mahasiswa PNP</span>
        </div>
      </div>
    </div>
  </div>
</footer>
