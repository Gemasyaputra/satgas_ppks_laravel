<section id="artikel" class="bg-gradient-to-br from-orange-50 via-amber-50 to-orange-100 py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-700 px-4 py-2 rounded-full mb-4">
                <i class="bi bi-book-fill w-4 h-4"></i>
                <span class="text-sm">Edukasi & Informasi</span>
            </div>
            <h2 class="text-4xl text-gray-800 mb-4">Artikel & Edukasi</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tips, informasi, dan panduan kesehatan mental untuk mendukung perjalanan akademik Anda.
            </p>
        </div>

        {{-- Coming Soon --}}
        <div class="bg-white rounded-2xl p-8 shadow-lg mb-12">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-plus-lg text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl text-gray-800 mb-2">Segera Hadir!</h3>
                <p class="text-gray-600">
                    Kami sedang menyiapkan artikel-artikel edukatif yang bermanfaat untuk Anda
                </p>
            </div>

            {{-- Upcoming Articles --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($articles as $article)
                <div class="bg-white rounded-2xl shadow-lg flex flex-col hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="text-center p-4">
                        <div class="text-5xl mb-2">
                            {{ $article->icon ?? '📄' }}
                        </div>
                        <span class="inline-block bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs mb-2">
                            {{ $article->category }}
                        </span>
                    </div>
                    <div class="p-4 text-center flex-1 flex flex-col">
                        <h4 class="text-gray-800 mb-2 font-medium">{{ $article->title }}</h4>
                        <p class="text-gray-600 text-sm flex-1">{{ $article->excerpt }}</p>
                        <a href="{{ route('student.articles.show', $article->id) }}" class="mt-4 inline-flex items-center justify-center px-4 py-2 bg-white border border-orange-500 text-orange-600 rounded-lg hover:bg-orange-50 transition-colors">
                            Baca Selengkapnya
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500 text-lg">Artikel terbaru akan segera hadir!</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Newsletter Signup --}}
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-8 text-center text-white">
            <h3 class="text-2xl mb-2">Dapatkan Notifikasi Artikel Terbaru</h3>
            <p class="text-orange-100 mb-6">
                Jadilah yang pertama tahu ketika artikel edukatif baru kami tersedia
            </p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input 
                    type="email" 
                    placeholder="Masukkan email Anda..."
                    class="flex-1 px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500"
                />
                <button class="bg-white text-orange-600 hover:bg-gray-100 px-6 py-3 rounded-lg transition-colors inline-flex items-center justify-center">
                    Berlangganan
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>
                </div>
        </div>
    </div>
</section>
