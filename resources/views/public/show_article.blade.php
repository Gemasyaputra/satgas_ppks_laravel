@extends('layouts.public')

@section('content')
    <div class="container py-5" style="max-width: 900px;">
        <a href="/#artikel" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Artikel
        </a>

        <div class="card shadow-sm border-0">
            <div class="card-body p-lg-5">
                <h1 class="h2 fw-bold text-dark mb-3">{{ $article->title }}</h1>

                <div class="d-flex align-items-center gap-4 text-muted mb-3">
                    <span class="badge bg-warning-subtle text-warning-emphasis fs-6">{{ $article->category }}</span>
                    <span><i class="bi bi-person-fill me-1"></i> oleh {{ $article->author }}</span>
                    <span>
                        <i class="bi bi-calendar-fill me-1"></i>
                        @if ($article->published_at)
                            {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                        @endif
                    </span>
                </div>

                @if ($article->image_url)
                    <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://via.placeholder.com/...' }}"
                        ...>

                    <div class="article-content" style="white-space: pre-wrap; line-height: 1.8;">
                        <p>{{ $article->content }}</p>
                    </div>
            </div>
        </div>
    </div>
@endsection
