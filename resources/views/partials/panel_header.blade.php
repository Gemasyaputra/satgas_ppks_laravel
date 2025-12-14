<header class="navbar navbar-light bg-white border-bottom p-3">
    <div class="container-fluid">
        <h1 class="fs-4 fw-medium text-dark mb-0">@yield('title')</h1>

        <div class="d-flex align-items-center">
            <i class="bi bi-person-fill text-warning me-2 fs-5"></i>
            
            <span class="navbar-text fw-semibold">
                Hai, {{ Auth::user()->name }}
            </span>

            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill ms-2">
                @if(Auth::user()->role == 'admin')
                    Admin
                @elseif(Auth::user()->role == 'lecturer')
                    Dosen
                @elseif(Auth::user()->role == 'public')
                    Masyarakat Umum
                @else
                    Mahasiswa
                @endif
            </span>

            <button class="btn btn-outline-secondary ms-3 d-lg-none" id="headerSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>
</header>