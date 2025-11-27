<section id="artikel" class="bg-gradient-to-br from-orange-50 via-amber-50 to-orange-100 py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full mb-4">
                <i class="bi bi-book-fill text-sm"></i>
                <span class="text-sm font-medium">Edukasi & Informasi</span>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Artikel & Edukasi</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tips, informasi, dan panduan kesehatan mental untuk mendukung perjalanan akademik Anda.
            </p>
        </div>

        {{-- LOGIKA: Cek ketersediaan artikel --}}
        @if ($articles->isEmpty())

            {{-- TAMPILAN JIKA KOSONG (COMING SOON) --}}
            <div class="bg-white rounded-2xl p-12 shadow-lg mb-12 text-center max-w-2xl mx-auto">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                    <i class="bi bi-hourglass-split text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Segera Hadir!</h3>
                <p class="text-gray-600">
                    Kami sedang menyiapkan artikel-artikel edukatif yang bermanfaat untuk Anda. Pantau terus halaman
                    ini!
                </p>
            </div>
        @else
            <div class="flex flex-wrap justify-center gap-8 mb-12">
                @foreach ($articles as $article)
                    {{-- Tambahkan w-full sm:w-1/2 lg:w-1/4 agar lebar kartu responsif --}}
                    <div
                        class="w-full md:w-[350px] bg-white rounded-2xl shadow-lg flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group overflow-hidden">

                        {{-- BAGIAN GAMBAR (Thumbnail) --}}
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://placehold.co/600x400/fff7ed/ea580c?text=Artikel+Edukasi' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">

                            <span
                                class="absolute top-3 right-3 bg-white/90 backdrop-blur-md text-orange-600 px-3 py-1 rounded-full text-xs font-bold shadow-sm border border-orange-100">
                                {{ $article->category }}
                            </span>
                        </div>

                        {{-- BAGIAN KONTEN --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <h4 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 h-14 leading-tight">
                                {{ $article->title }}
                            </h4>

                            <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>

                            {{-- UBAH DISINI: Arahkan ke route publik --}}
                            <a href="{{ route('public.article.show', $article->id) }}"
                                class="mt-auto w-full inline-flex items-center justify-center px-4 py-2.5 bg-white border border-orange-200 text-orange-600 font-medium rounded-xl hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-all duration-300 group-hover:shadow-md">
                                Baca Selengkapnya
                                <i class="bi bi-arrow-right ms-2 transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PERBAIKAN 2: Tombol "Lihat Semua" sebagai penutup Section --}}
            <div class="text-center">
                {{-- UBAH DISINI: Arahkan ke route public.articles.index --}}
                <a href="{{ route('public.articles.index') }}"
                    class="inline-flex items-center gap-2 text-orange-600 font-bold hover:text-orange-700 hover:underline transition-all text-lg">
                    Lihat Semua Artikel Edukasi
                    <i class="bi bi-arrow-right-circle-fill text-2xl"></i>
                </a>
            </div>
        @endif

        {{-- Newsletter Signup --}}
        {{-- <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl p-8 md:p-12 text-center text-white shadow-xl">
            <h3 class="text-2xl md:text-3xl font-bold mb-3">Dapatkan Notifikasi Artikel Terbaru</h3>
            <p class="text-orange-100 mb-8 text-lg">
                Jadilah yang pertama tahu ketika artikel edukatif baru kami tersedia
            </p>
            <form action="#" class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input 
                    type="email" 
                    placeholder="Masukkan email Anda..."
                    class="flex-1 px-6 py-3.5 rounded-xl text-gray-900 placeholder-gray-500 focus:ring-4 focus:ring-orange-300 focus:outline-none border-0"
                    required
                />
                <button type="submit" class="bg-white text-orange-600 hover:bg-orange-50 font-bold px-8 py-3.5 rounded-xl transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                    Berlangganan
                    <i class="bi bi-send-fill ms-2"></i>
                </button>
            </form>
        </div> --}}

    </div>
</section>
