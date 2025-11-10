@extends('layouts.student')

@section('title', 'Artikel & Edukasi')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 bg-warning-subtle text-warning-emphasis">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <i class="bi bi-book-fill fs-1 me-3"></i>
                    <div>
                        <h2 class="h4 fw-medium mb-1">Artikel & Edukasi</h2>
                        <p class="text-muted mb-0">Baca artikel edukatif tentang kesehatan mental dan pencegahan kekerasan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            @foreach ($stats as $stat)
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">{{ $stat['name'] }}</p>
                                <h3 class="fw-bold mb-0">{{ $stat['count'] }}</h3>
                            </div>
                            <i class="bi bi-file-text-fill fs-1 {{ $stat['color'] }} opacity-25"></i>
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
                                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control border-0 bg-light"
                                    placeholder="Cari artikel berdasarkan judul atau konten..."
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select bg-light border-0">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-warning w-100 text-white">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse ($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://via.placeholder.com/...' }}"
                            ...>
                        <span class="badge bg-warning position-absolute top-0 end-0 m-2">{{ $article->category }}</span>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-medium text-dark">{{ $article->title }}</h5>
                            <p class="card-text text-muted small flex-grow-1">{{ $article->excerpt }}</p>

                            <div class="d-flex justify-content-between text-muted small mb-3">
                                <span><i class="bi bi-person-fill me-1"></i> {{ $article->author }}</span>
                                <span>
                                    <i class="bi bi-calendar-fill me-1"></i>
                                    @if ($article->published_at)
                                        {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                    @endif
                                </span>
                            </div>

                            <a href="{{ route('student.articles.show', $article->id) }}"
                                class="btn btn-warning text-white w-100">
                                <i class="bi bi-eye-fill me-1"></i> Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-file-earmark-x-fill fs-1 text-muted"></i>
                            <h5 class="mt-3">Tidak ada artikel yang ditemukan</h5>
                            <p class="text-muted">Coba ubah kata kunci pencarian atau filter kategori Anda.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
