<section id="artikel" class="container-fluid py-5 my-5" style="background-color: #FFF7ED;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-book-fill me-1"></i> Edukasi & Informasi
            </span>
            <h2 class="h1 fw-bold text-dark mb-3">Artikel & Edukasi</h2>
            <p class="fs-5 text-muted col-lg-8 mx-auto">
                Tips, informasi, dan panduan kesehatan mental untuk mendukung perjalanan akademik Anda.
            </p>
        </div>
        
        <div class="row g-4">
            @forelse($articles as $article)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                   <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://via.placeholder.com/...' }}" ...>
                    <div class="card-body">
                        <span class="badge bg-warning-subtle text-warning-emphasis mb-2">{{ $article->category }}</span>
                        <h5 class="card-title fw-medium text-dark">{{ $article->title }}</h5>
                        <p class="card-text text-muted small">{{ $article->excerpt }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0 pb-3">
                        <a href="{{ route('student.articles.show', $article->id) }}" class="btn btn-outline-warning w-100">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted fs-5">Artikel terbaru akan segera hadir!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>