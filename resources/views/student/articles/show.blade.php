@extends('layouts.student')

@section('title', 'Baca Artikel')

@section('content')
<div class="container" style="max-width: 800px;"> <a href="{{ route('student.articles.index') }}" class="btn btn-link text-decoration-none text-muted mb-3 ps-0 fw-medium">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Artikel
    </a>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        
        <div class="position-relative">
            <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://placehold.co/800x400/fff3cd/fd7e14?text=Artikel+Edukasi' }}"
                 alt="{{ $article->title }}" 
                 class="w-100 object-fit-cover"
                 style="height: 400px; max-height: 50vh;"> <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark fw-bold shadow-sm px-3 py-2 rounded-pill">
                {{ $article->category }}
            </span>
        </div>

        <div class="card-body p-4 p-lg-5">
            <div class="d-flex align-items-center gap-3 text-muted small mb-3">
                <span class="d-flex align-items-center">
                    <i class="bi bi-person-circle me-2 text-warning fs-5"></i>
                    <span class="fw-medium text-dark">{{ $article->author }}</span>
                </span>
                <span class="text-secondary">&bull;</span>
                <span class="d-flex align-items-center">
                    <i class="bi bi-calendar-event me-2"></i>
                    @if ($article->published_at)
                        {{ \Carbon\Carbon::parse($article->published_at)->isoFormat('D MMMM Y') }}
                    @else
                        Draft
                    @endif
                </span>
            </div>

            <h1 class="fw-bold text-dark mb-4 lh-sm">{{ $article->title }}</h1>
            
            <hr class="text-secondary opacity-10 mb-4">

            <div class="article-content text-dark opacity-75" style="white-space: pre-wrap; line-height: 1.8; font-size: 1.05rem;">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="mt-5 pt-4 border-top">
                <p class="fw-bold mb-2">Bagikan artikel ini:</p>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-twitter-x"></i> Twitter</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-link-45deg"></i> Salin Link</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection