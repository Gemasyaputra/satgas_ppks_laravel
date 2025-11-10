<div class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end"
    style="width: 280px; height: 100vh; position: fixed;">
    <a href="{{ route('student.dashboard') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas PPKS" style="height: 50px;">
        <div class="ms-2">
            <span class="fs-6 fw-medium text-dark">Portal Mahasiswa</span><br>
            <span class="text-muted" style="font-size: 0.9rem;">PPKS PNP</span>
        </div>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('student.dashboard') }}"
                class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : 'link-dark' }}">
                <i class="bi bi-grid-1x2-fill me-2"></i> Beranda
            </a>
        </li>
        <li>
            <a href="{{ route('student.profile.index') }}"
                class="nav-link {{ request()->routeIs('student.profile.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-person-fill me-2"></i> Profil Saya
            </a>
        </li>
        <li>
            <a href="{{ route('student.articles.index') }}"
                class="nav-link {{ request()->routeIs('student.articles.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-book-fill me-2"></i> Artikel & Edukasi
            </a>
        </li>
        <li>
            <a href="{{ route('student.reports.index') }}"
                class="nav-link {{ request()->routeIs('student.reports.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-file-earmark-medical-fill me-2"></i> Laporan Saya
            </a>
        </li>
        <li>
            <a href="{{ route('student.counseling.index') }}"
                class="nav-link {{ request()->routeIs('student.counseling.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-calendar-check-fill me-2"></i> Jadwal Konseling
            </a>
        </li>
    </ul>
    <hr>
    <div>
        <a href="{{ route('logout') }}" class="d-flex align-items-center link-danger text-decoration-none p-2"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i>
            <strong>Keluar</strong>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
