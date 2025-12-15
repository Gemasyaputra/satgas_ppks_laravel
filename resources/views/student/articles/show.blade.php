@extends('layouts.student')

@section('title', 'Baca Artikel')

@section('content')
    <div class="container" style="max-width: 800px;"> <a href="{{ route('student.articles.index') }}"
            class="btn btn-link text-decoration-none text-muted mb-3 ps-0 fw-medium">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Artikel
        </a>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

            <div class="position-relative">
                <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://placehold.co/800x400/fff3cd/fd7e14?text=Artikel+Edukasi' }}"
                    alt="{{ $article->title }}" class="w-100 object-fit-cover" style="height: 400px; max-height: 50vh;"> <span
                    class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark fw-bold shadow-sm px-3 py-2 rounded-pill">
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

                <div class="article-content text-dark opacity-75"
                    style="white-space: pre-wrap; line-height: 1.8; font-size: 1.05rem;">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <p class="fw-bold mb-2">Bagikan artikel ini:</p>
                    <div class="d-flex gap-2">
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
                <div id="copyToast"
                    class="fixed bottom-5 right-5 bg-gray-900 text-white px-4 py-3 rounded-lg shadow-xl flex items-center gap-3 transform transition-all duration-300 translate-y-20 opacity-0 z-50">
                    <i class="bi bi-check-circle-fill text-green-400"></i>
                    <span class="text-sm font-medium">Link berhasil disalin!</span>
                </div>

            </div>
        </div>
    </div>
@endsection

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            const toast = document.getElementById('copyToast');
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }
</script>
