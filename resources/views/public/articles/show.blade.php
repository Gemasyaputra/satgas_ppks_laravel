@extends('layouts.public')

@section('title', $article->title)

@section('content')
    <div class="bg-white pt-12 pb-20">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
                <a href="{{ route('public.home') }}" class="hover:text-orange-600 transition-colors">Beranda</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <a href="{{ route('public.articles.index') }}" class="hover:text-orange-600 transition-colors">Artikel</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-gray-900 font-medium truncate max-w-[200px]">{{ $article->title }}</span>
            </nav>

            {{-- Article Header --}}
            <div class="text-center mb-10">
                <span class="inline-block bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-bold mb-4">
                    {{ $article->category }}
                </span>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                <div class="flex items-center justify-center gap-4 text-sm text-gray-500 border-y border-gray-100 py-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="font-medium text-gray-900">{{ $article->author }}</span>
                    </div>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-calendar3"></i>
                        {{ \Carbon\Carbon::parse($article->published_at)->format('d F Y') }}
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="rounded-2xl overflow-hidden shadow-lg mb-10">
                <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : '[https://placehold.co/1200x600/fff7ed/ea580c?text=Artikel+Edukasi](https://placehold.co/1200x600/fff7ed/ea580c?text=Artikel+Edukasi)' }}"
                    alt="{{ $article->title }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>

            {{-- Article Content --}}
            <article
                class="prose prose-lg max-w-none prose-orange prose-img:rounded-xl prose-headings:text-gray-900 text-gray-700 leading-relaxed">
                {!! nl2br(e($article->content)) !!}
            </article>

            {{-- Share & Tags --}}
            <div class="mt-12 pt-8 border-t border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="font-bold text-gray-900">Bagikan artikel ini:</p>
                    <div class="flex gap-3">

                        {{-- 1. Tombol WhatsApp --}}
                        {{-- PERBAIKAN: Menggunakan $article->id --}}
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . route('public.article.show', $article->id)) }}"
                            target="_blank"
                            class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all decoration-none"
                            title="Bagikan ke WhatsApp">
                            <i class="bi bi-whatsapp text-lg"></i>
                        </a>

                        {{-- 2. Tombol Twitter / X --}}
                        {{-- PERBAIKAN: Menggunakan $article->id --}}
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(route('public.article.show', $article->id)) }}"
                            target="_blank"
                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all decoration-none"
                            title="Bagikan ke X (Twitter)">
                            <i class="bi bi-twitter-x text-lg"></i>
                        </a>

                        {{-- 3. Tombol Salin Link (Copy) --}}
                        {{-- PERBAIKAN: Menggunakan $article->id --}}
                        <button onclick="copyToClipboard('{{ route('public.article.show', $article->id) }}')"
                            class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-600 hover:text-white transition-all focus:outline-none"
                            title="Salin Link">
                            <i class="bi bi-link-45deg text-xl"></i>
                        </button>

                    </div>
                </div>
            </div>

            {{-- Toast Notifikasi (Muncul saat link disalin) --}}
            <div id="copyToast"
                class="fixed bottom-5 right-5 bg-gray-900 text-white px-4 py-3 rounded-lg shadow-xl flex items-center gap-3 transform transition-all duration-300 translate-y-20 opacity-0 z-50">
                <i class="bi bi-check-circle-fill text-green-400"></i>
                <span class="text-sm font-medium">Link berhasil disalin!</span>
            </div>

            {{-- Related Articles --}}
            @if ($relatedArticles->isNotEmpty())
                <div class="mt-16">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($relatedArticles as $related)
                            <a href="{{ route('public.article.show', $related->id) }}" class="group">
                                <div
                                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all h-full flex flex-col">
                                    <div class="h-40 overflow-hidden">
                                        <img src="{{ $related->image_url ? asset('storage/' . $related->image_url) : '[https://placehold.co/600x400/fff7ed/ea580c?text=Related](https://placehold.co/600x400/fff7ed/ea580c?text=Related)' }}"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                    <div class="p-4 flex-1">
                                        <h4 class="font-bold text-gray-900 group-hover:text-orange-600 line-clamp-2 mb-2">
                                            {{ $related->title }}
                                        </h4>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($related->published_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

{{-- Script Baru (Khusus Tailwind) --}}
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Ambil elemen toast
            const toast = document.getElementById('copyToast');

            // Munculkan toast (Hapus class yang menyembunyikan)
            toast.classList.remove('translate-y-20', 'opacity-0');

            // Sembunyikan lagi setelah 2 detik
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }
</script>
