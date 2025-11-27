@extends('layouts.student')

@section('title', 'Artikel & Edukasi')

@section('content')
<div class="container-fluid">
    
    <div class="card shadow-sm border-0 mb-4 bg-warning-subtle text-warning-emphasis">
        <div class="card-body p-4">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-50 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                    <i class="bi bi-book-fill fs-2"></i>
                </div>
                <div>
                    <h2 class="h4 fw-bold mb-1">Artikel & Edukasi</h2>
                    <p class="text-dark opacity-75 mb-0">Baca artikel edukatif tentang kesehatan mental dan pencegahan kekerasan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 g-3">
        @foreach ($stats as $stat)
            <div class="col-md-3">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small text-uppercase fw-bold">{{ $stat['name'] }}</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ $stat['count'] }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-file-text-fill fs-4 {{ $stat['color'] ?? 'text-warning' }}"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('student.articles.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-0 bg-light"
                                placeholder="Cari judul artikel..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select bg-light border-0 text-muted" style="cursor: pointer;">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-warning w-100 text-white fw-bold shadow-sm">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse ($articles as $article)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 overflow-hidden hover-shadow transition">
                    <div class="position-relative">
                        <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://placehold.co/600x400/fff3cd/fd7e14?text=Artikel' }}"
                             alt="{{ $article->title }}" 
                             class="card-img-top w-100 object-fit-cover"
                             style="height: 200px;">
                        
                        <span class="badge bg-warning text-dark fw-bold position-absolute top-0 end-0 m-3 shadow-sm">
                            {{ $article->category }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold text-dark mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 3rem;">
                            {{ $article->title }}
                        </h5>
                        
                        <p class="card-text text-muted small flex-grow-1 mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $article->excerpt }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center text-muted small mb-3 pt-3 border-top">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-person-circle me-1 text-warning"></i> {{ $article->author }}
                            </span>
                            <span>
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : '-' }}
                            </span>
                        </div>

                        <a href="{{ route('student.articles.show', $article->id) }}"
                            class="btn btn-outline-warning fw-bold w-100 mt-auto">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body text-center p-5">
                        <div class="bg-white p-3 rounded-circle d-inline-block shadow-sm mb-3">
                            <i class="bi bi-search fs-1 text-warning"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Tidak ada artikel ditemukan</h5>
                        <p class="text-muted">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                        <a href="{{ route('student.articles.index') }}" class="btn btn-link text-warning fw-bold text-decoration-none">
                            Reset Pencarian
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
</div>
@endsection