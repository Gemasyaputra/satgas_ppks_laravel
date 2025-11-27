@extends('layouts.public') {{-- Sesuaikan dengan layout publik kamu --}}

@section('title', 'Artikel & Edukasi')

@section('content')
{{-- HEADER HERO --}}
<div class="bg-orange-50 py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-orange-100 text-orange-600 text-sm font-bold mb-4">
            Pusat Informasi
        </span>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Artikel & Edukasi Kesehatan Mental</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Jelajahi kumpulan artikel, panduan, dan berita terbaru seputar pencegahan kekerasan dan kesehatan mental di lingkungan kampus.
        </p>
    </div>
</div>

{{-- CONTENT SECTION --}}
<div class="max-w-7xl mx-auto px-6 py-12">
    
    {{-- SEARCH & FILTER BAR --}}
    <div class="bg-white rounded-xl shadow-sm p-4 mb-10 border border-gray-100">
        <form action="{{ route('public.articles.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari judul artikel..." 
                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-orange-500 focus:ring-orange-500 transition-colors">
            </div>
            <div class="w-full md:w-1/4">
                <select name="category" class="w-full py-3 px-4 rounded-lg border border-gray-200 focus:border-orange-500 focus:ring-orange-500 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-8 py-3 bg-orange-600 text-white font-bold rounded-lg hover:bg-orange-700 transition-colors shadow-md">
                Cari
            </button>
        </form>
    </div>

    {{-- ARTICLE GRID --}}
    @if($articles->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-2xl">
            <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                <i class="bi bi-search text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700">Tidak ada artikel ditemukan</h3>
            <p class="text-gray-500 mt-2">Coba kata kunci lain atau reset filter pencarian.</p>
            <a href="{{ route('public.articles.index') }}" class="inline-block mt-4 text-orange-600 font-bold hover:underline">Reset Pencarian</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
                    
                    {{-- Thumbnail --}}
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://placehold.co/600x400/fff7ed/ea580c?text=Artikel' }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-white/90 backdrop-blur text-orange-600 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $article->category }}
                        </span>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                            <i class="bi bi-calendar-event"></i>
                            {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : '-' }}
                            <span class="mx-1">•</span>
                            <i class="bi bi-person"></i> {{ $article->author }}
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-orange-600 transition-colors">
                            <a href="{{ route('public.article.show', $article->id) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-1">
                            {{ $article->excerpt }}
                        </p>

                        <a href="{{ route('public.article.show', $article->id) }}" class="mt-auto inline-flex items-center text-orange-600 font-bold hover:underline">
                            Baca Selengkapnya <i class="bi bi-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-12 flex justify-center">
            {{ $articles->withQueryString()->links() }} {{-- Pastikan pakai Tailwind Pagination View --}}
        </div>
    @endif
</div>
@endsection