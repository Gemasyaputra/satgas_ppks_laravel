<section id="tentang" class="container py-5 my-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas PPKPT" class="img-fluid rounded-circle" style="filter: drop-shadow(0 5px 5px rgba(0,0,0,0.1));">
        </div>
        <div class="col-lg-6">
            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 mb-3">
                <i class="bi bi-shield-check me-1"></i> Tentang Satgas PPKPT
            </span>
            <h2 class="h1 fw-bold text-dark mb-4">Melindungi & Mendukung Mahasiswa PNP</h2>
            <p class="fs-5 text-muted mb-3">
                Satgas PPKPT Politeknik Negeri Padang adalah tim khusus yang didedikasikan untuk mendukung mahasiswa dalam menjaga kesehatan mental dan memastikan perlindungan hak-hak mereka.
            </p>
            <p class="text-muted mb-4">
                Tim kami terdiri dari <strong class="text-warning">mahasiswa anggota Satgas</strong> dan 
                <strong class="text-warning">tenaga pendidik kampus</strong> yang bekerja sama 
                menyediakan layanan konseling, advokasi, dan edukasi.
            </p>
            <h5 class="fw-medium">Tim Kami (Anggota Satgas & Konselor):</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach($team as $member)
                    <span class="badge bg-dark-subtle text-dark-emphasis p-2">{{ $member->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>