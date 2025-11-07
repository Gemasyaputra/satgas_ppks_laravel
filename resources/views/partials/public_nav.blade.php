<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid mx-lg-5">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas PPKPT" style="height: 50px;">
            <div class="ms-2 d-flex flex-column">
                <span class="fw-semibold text-warning" style="font-size: 1.1rem;">Satgas PPKPT</span>
                <span class="text-muted" style="font-size: 0.8rem;">Politeknik Negeri Padang</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#layanan">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#artikel">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#kontak">Kontak</a>
                </li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-warning text-white fw-bold px-4 rounded-pill">Masuk</a>
        </div>
    </div>
</nav>