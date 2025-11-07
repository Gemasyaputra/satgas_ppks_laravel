<section id="kontak" class="container-fluid py-5 my-5" style="background-color: #FFF7ED;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-telephone-fill me-1"></i> Kontak Darurat
            </span>
            <h2 class="h1 fw-bold text-dark mb-3">Hubungi Kami</h2>
            <p class="fs-5 text-muted col-lg-8 mx-auto">
                Jika Anda membutuhkan bantuan segera atau ingin berkonsultasi, jangan ragu untuk menghubungi kami.
            </p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @if($contactMethods['hotline'])
            <div class="col-md-4">
                <div class="card shadow-sm border-danger-subtle h-100 text-center p-4">
                    <div class="card-body">
                        <div class="icon-circle bg-danger-subtle text-danger d-inline-flex p-3 rounded-circle mb-3">
                            <i class="bi bi-telephone-fill fs-2"></i>
                        </div>
                        <h4 class="fw-medium text-dark">{{ $contactMethods['hotline']->title }}</h4>
                        <p class="text-muted">{{ $contactMethods['hotline']->description }}</p>
                        <span class="badge bg-danger-subtle text-danger-emphasis p-2 fs-6">
                            {{ $contactMethods['hotline']->phone }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            @if($contactMethods['email'])
            <div class="col-md-4">
                <div class="card shadow-sm border-primary-subtle h-100 text-center p-4">
                    <div class="card-body">
                        <div class="icon-circle bg-primary-subtle text-primary d-inline-flex p-3 rounded-circle mb-3">
                            <i class="bi bi-envelope-fill fs-2"></i>
                        </div>
                        <h4 class="fw-medium text-dark">{{ $contactMethods['email']->title }}</h4>
                        <p class="text-muted">{{ $contactMethods['email']->description }}</p>
                        <span class="badge bg-primary-subtle text-primary-emphasis p-2 fs-6">
                            {{ $contactMethods['email']->phone }} </span>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="col-md-4">
                <div class="card shadow-sm border-success-subtle h-100 text-center p-4">
                    <div class="card-body">
                        <div class="icon-circle bg-success-subtle text-success d-inline-flex p-3 rounded-circle mb-3">
                            <i class="bi bi-geo-alt-fill fs-2"></i>
                        </div>
                        <h4 class="fw-medium text-dark">Lokasi Kantor</h4>
                        <p class="text-muted">Gedung Rektorat, Lantai 2, Ruang Satgas PPKPT</p>
                        <span class="badge bg-success-subtle text-success-emphasis p-2">
                            Politeknik Negeri Padang
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>