<footer class="bg-dark text-white">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas PPKPT" style="height: 50px;">
                    <div class="ms-2">
                        <span class="fw-semibold text-warning fs-5">Satgas PPKPT</span><br>
                        <span class="text-muted small">Politeknik Negeri Padang</span>
                    </div>
                </div>
                <p class="text-muted small">Mendukung kesejahteraan mental dan melindungi hak mahasiswa.</p>
            </div>
            
            <div class="col-md-2">
                <h5 class="text-white mb-3">Navigasi</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#beranda" class="nav-link p-0 text-muted">Beranda</a></li>
                    <li class="nav-item mb-2"><a href="#layanan" class="nav-link p-0 text-muted">Layanan</a></li>
                    <li class="nav-item mb-2"><a href="#artikel" class="nav-link p-0 text-muted">Artikel</a></li>
                    <li class="nav-item mb-2"><a href="#tentang" class="nav-link p-0 text-muted">Tentang</a></li>
                    <li class="nav-item mb-2"><a href="#kontak" class="nav-link p-0 text-muted">Kontak</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5 class="text-white mb-3">Kontak</h5>
                <ul class="nav flex-column">
                    @if($contactMethods['hotline'])
                    <li class="nav-item mb-2 text-muted small"><i class="bi bi-telephone-fill me-2 text-warning"></i> {{ $contactMethods['hotline']->phone }}</li>
                    @endif
                    @if($contactMethods['email'])
                    <li class="nav-item mb-2 text-muted small"><i class="bi bi-envelope-fill me-2 text-warning"></i> {{ $contactMethods['email']->phone }}</li>
                    @endif
                    <li class="nav-item mb-2 text-muted small"><i class="bi bi-geo-alt-fill me-2 text-warning"></i> Gedung Rektorat, Lt. 2</li>
                </ul>
            </div>
            
            <div class="col-md-3">
                 <h5 class="text-white mb-3">Akses Panel</h5>
                 <p class="text-muted small">Login sebagai mahasiswa atau admin untuk mengakses panel.</p>
                 <a href="{{ route('login') }}" class="btn btn-warning text-white fw-bold">Login Sekarang</a>
            </div>
        </div>
    </div>
    <div class="border-top border-secondary-subtle">
        <p class="text-center text-muted small mb-0 py-3">
            © 2025 Satgas PPKPT Politeknik Negeri Padang.
        </p>
    </div>
</footer>