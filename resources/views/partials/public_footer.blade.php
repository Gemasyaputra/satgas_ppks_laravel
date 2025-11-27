<footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            {{-- 1. Logo & Deskripsi --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img 
                        src="{{ asset('images/logo.png') }}" 
                        alt="Logo Satgas PPKPT" 
                        class="w-12 h-12 object-contain filter drop-shadow-md bg-white/10 rounded-full p-1"
                    >
                    <div>
                        <div class="text-lg font-bold text-white tracking-wide">Satgas PPKPT</div>
                        <div class="text-gray-400 text-xs uppercase tracking-wider">Politeknik Negeri Padang</div>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Garda terdepan dalam menciptakan lingkungan kampus yang aman, bebas kekerasan seksual, dan mendukung kesehatan mental civitas akademika.
                </p>
            </div>

            {{-- 2. Navigasi Cepat --}}
            <div>
                <h4 class="text-lg font-bold mb-6 text-white relative inline-block">
                    Navigasi
                    <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-orange-500 rounded-full -mb-2"></span>
                </h4>
                {{-- Tambahkan mt-2 untuk memberi jarak ekstra --}}
                <ul class="space-y-3 text-sm mt-2">
                    @foreach(['beranda' => 'Beranda', 'layanan' => 'Layanan', 'artikel' => 'Artikel', 'tentang' => 'Tentang', 'kontak' => 'Hubungi Kami'] as $id => $label)
                    <li>
                        <a href="{{ route('public.home') }}#{{ $id }}" 
                           class="group flex items-center !text-gray-300 hover:!text-orange-500 transition-all duration-300 !no-underline">
                            <span class="w-0 overflow-hidden group-hover:w-4 transition-all duration-300 text-orange-500">
                                <i class="bi bi-chevron-right text-xs"></i>
                            </span>
                            <span>{{ $label }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- 3. Layanan Kami --}}
            <div>
                <h4 class="text-lg font-bold mb-6 text-white relative inline-block">
                    Layanan
                    <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-orange-500 rounded-full -mb-2"></span>
                </h4>
                {{-- Tambahkan mt-2 untuk memberi jarak ekstra --}}
                <ul class="space-y-3 text-sm !text-gray-300 mt-2">
                    <li class="flex items-center gap-2 group hover:text-white transition-colors cursor-default">
                        <i class="bi bi-check-circle-fill text-orange-500 text-xs group-hover:scale-110 transition-transform"></i> 
                        Konseling Psikologis
                    </li>
                    <li class="flex items-center gap-2 group hover:text-white transition-colors cursor-default">
                        <i class="bi bi-check-circle-fill text-orange-500 text-xs group-hover:scale-110 transition-transform"></i> 
                        Pendampingan Hukum
                    </li>
                    <li class="flex items-center gap-2 group hover:text-white transition-colors cursor-default">
                        <i class="bi bi-check-circle-fill text-orange-500 text-xs group-hover:scale-110 transition-transform"></i> 
                        Hotline Darurat 24/7
                    </li>
                    <li class="flex items-center gap-2 group hover:text-white transition-colors cursor-default">
                        <i class="bi bi-check-circle-fill text-orange-500 text-xs group-hover:scale-110 transition-transform"></i> 
                        Edukasi Pencegahan
                    </li>
                </ul>
            </div>

            {{-- 4. Kontak Kami --}}
            <div>
                <h4 class="text-lg font-bold mb-6 text-white relative inline-block">
                    Kontak
                    <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-orange-500 rounded-full -mb-2"></span>
                </h4>
                <div class="space-y-4 text-sm !text-gray-300 mt-2">
                    <div class="flex items-start gap-3">
                        <i class="bi bi-geo-alt-fill text-orange-500 mt-1 flex-shrink-0"></i>
                        <span>
                            Gedung PKM, Lantai 2 <br>
                            Politeknik Negeri Padang <br>
                            Limau Manis, Padang
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-telephone-fill text-orange-500 flex-shrink-0"></i>
                        <span class="font-mono text-gray-200">+62 851-8205-6839</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-envelope-fill text-orange-500 flex-shrink-0"></i>
                        <span class="font-mono text-gray-200">satgasppkspnp@pnp.ac.id</span>
                    </div>
                    
                    {{-- Social Media Icons --}}
                    <div class="flex gap-3 mt-4 pt-4 border-t border-gray-700">
                        <a href="https://instagram.com/satgasppkspoltekpadang" target="_blank" class="w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center hover:bg-orange-600 text-white transition-all shadow-lg border border-gray-700 hover:border-orange-500 !no-underline">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="mailto:satgasppkspnp@pnp.ac.id" class="w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 text-white transition-all shadow-lg border border-gray-700 hover:border-blue-500 !no-underline">
                            <i class="bi bi-envelope"></i>
                        </a>
                        <a href="https://wa.me/6285182056839" target="_blank" class="w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green-600 text-white transition-all shadow-lg border border-gray-700 hover:border-green-500 !no-underline">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm text-center md:text-left">
                &copy; {{ date('Y') }} Satgas PPKPT Politeknik Negeri Padang. <br class="md:hidden"> Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-1 text-sm text-gray-500">
                <span>Dibuat dengan</span>
                <i class="bi bi-heart-fill text-red-500 animate-pulse"></i>
                <span>untuk Mahasiswa PNP</span>
            </div>
        </div>
    </div>
</footer>