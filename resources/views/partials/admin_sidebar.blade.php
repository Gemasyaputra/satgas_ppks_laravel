<div class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end"
    style="width: 280px; height: 100vh; position: fixed;">
    <a href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas PPKS" style="height: 50px;">
        <div class="ms-2">
            <span class="fs-6 fw-medium text-warning">Satgas PPKS</span><br>
            <span class="text-muted" style="font-size: 0.9rem;">Politeknik Negeri Padang</span>
        </div>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'link-dark' }}">
                <i class="bi bi-grid-1x2-fill me-2"></i> Beranda
            </a>
        </li>
        <li>
            <a href="{{ route('admin.articles.index') }}"
                class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-file-text-fill me-2"></i> Artikel
            </a>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}"
                class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-question-circle-fill me-2"></i> Layanan
            </a>
        </li>
        <li>
            <a href="{{ route('admin.counselors.index') }}"
                class="nav-link {{ request()->routeIs('admin.counselors.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-person-circle me-2"></i> Konselor
            </a>
        </li>
        <li>
            <a href="{{ route('admin.students.index') }}"
                class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-people-fill me-2"></i> Mahasiswa
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reports.index') }}"
                class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-file-earmark-medical-fill me-2"></i> Laporan
            </a>
        </li>
        <a href="{{ route('admin.schedules.index') }}"
            class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : 'link-dark' }}">
            <i class="bi bi-calendar-check-fill me-2"></i> Jadwal Konseling
        </a>
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
