<section id="layanan" class="container py-5 my-5">
    <div class="text-center mb-5">
        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 mb-3">
            <i class="bi bi-heart-fill me-1"></i> Layanan Terpercaya
        </span>
        <h2 class="h1 fw-bold text-dark mb-3">Layanan Satgas PPKPT</h2>
        <p class="fs-5 text-muted col-lg-8 mx-auto">
            Kami menyediakan berbagai layanan profesional untuk mendukung kesejahteraan dan melindungi hak-hak mahasiswa PNP.
        </p>
    </div>
    
    <div class="row g-4">
        @forelse($services as $service)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-center p-4">
                <div class="card-body">
                    <div class="icon-circle bg-warning-subtle text-warning d-inline-flex p-3 rounded-circle mb-3">
                        @if($service->icon == 'phone' || Str::contains($service->title, 'Hotline'))
                            <i class="bi bi-telephone-fill fs-2"></i>
                        @elseif($service->icon == 'help' || Str::contains($service->title, 'Konseling'))
                            <i class="bi bi-chat-quote-fill fs-2"></i>
                        @else
                            <i class="bi bi-shield-fill-check fs-2"></i>
                        @endif
                    </div>
                    <h4 class="fw-medium text-dark">{{ $service->title }}</h4>
                    <p class="text-muted">{{ $service->description }}</p>
                    <span class="badge bg-dark-subtle text-dark-emphasis p-2">
                        <i class="bi bi-telephone-fill me-1"></i> {{ $service->phone }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Layanan sedang dipersiapkan.</p>
        @endforelse
    </div>
</section>