<style>
    /* CSS Khusus Sidebar Admin */
    #adminSidebar .nav-pills .nav-link.active,
    #adminSidebar .nav-pills .show>.nav-link {
        background-color: #fd7e14; /* Warna Orange Utama */
        color: #fff;
        box-shadow: 0 4px 6px rgba(253, 126, 20, 0.25); /* Shadow halus */
    }

    #adminSidebar .nav-link {
        color: #495057; /* Warna teks sedikit lebih lembut */
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 0.25rem; /* Jarak antar menu */
    }

    #adminSidebar .nav-link:hover:not(.active) {
        background-color: #fff7ed; /* Orange sangat muda (subtle) */
        color: #c2410c; /* Orange gelap */
        /* transform: translateX(3px); Efek geser sedikit */
        padding-left: 1.25rem;
    }

    #adminSidebar .nav-link i {
        font-size: 1.25rem;
        margin-right: 0.75rem;
        width: 24px; /* Lebar tetap agar teks rata */
        text-align: center;
    }
    
    /* Judul Kategori Menu */
    .nav-category {
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        padding-left: 1rem;
        color: #9ca3af;
    }
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm" id="adminSidebar"
    style="width: 280px; height: 100vh; position: fixed; top: 0; left: 0; overflow-y: auto; z-index: 1000;">

    {{-- Header Logo --}}
    <a href="{{ route('admin.dashboard') }}"
        class="d-flex align-items-center mb-4 mt-2 px-2 link-dark text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas" style="height: 42px; width: auto;">
        <div class="ms-3 lh-1">
            <span class="fs-5 fw-bold text-dark tracking-tight">Satgas PPKPT</span><br>
            <span class="text-secondary small text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 1px;">Admin Panel</span>
        </div>
    </a>

    <hr class="text-secondary opacity-10 mt-0 mb-3">

    {{-- Menu Navigasi --}}
    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i>
                Beranda
            </a>
        </li>

        {{-- SECTION: KONTEN --}}
        <li class="nav-item nav-category fw-bold text-uppercase">Konten & Data</li>

        <li>
            <a href="{{ route('admin.articles.index') }}"
                class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                Artikel
            </a>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}"
                class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-hdd-stack"></i>
                Layanan
            </a>
        </li>

        {{-- SECTION: PENGGUNA --}}
        <li class="nav-item nav-category fw-bold text-uppercase">Pengguna</li>

        <li>
            <a href="{{ route('admin.counselors.index') }}"
                class="nav-link {{ request()->routeIs('admin.counselors.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                Konselor
            </a>
        </li>
        <li>
            <a href="{{ route('admin.students.index') }}"
                class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Mahasiswa/User
            </a>
        </li>

        {{-- SECTION: AKTIVITAS --}}
        <li class="nav-item nav-category fw-bold text-uppercase">Aktivitas</li>

        <li>
            <a href="{{ route('admin.reports.index') }}"
                class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon"></i>
                Laporan Masuk
            </a>
        </li>
        <li>
            <a href="{{ route('admin.schedules.index') }}"
                class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i>
                Jadwal Pemeriksaan
            </a>
        </li>

        {{-- SECTION: PENGATURAN --}}
        <li class="nav-item nav-category fw-bold text-uppercase">Pengaturan</li>
        
        <li>
            <a href="{{ route('admin.profile.index') }}" 
               class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i> {{-- Ikon diganti jadi bi-gear-fill (lebih umum) --}}
                Pengaturan Akun
            </a>
        </li>

    </ul>

    <hr class="text-secondary opacity-10 my-3">

    {{-- Tombol Keluar --}}
    <div class="px-2 pb-3">
        <a href="{{ route('logout') }}"
            class="btn btn-light text-danger border-0 w-100 d-flex align-items-center justify-content-center py-2 fw-semibold shadow-sm"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            style="background-color: #fee2e2;"> {{-- Merah muda lembut --}}
            <i class="bi bi-box-arrow-right me-2"></i>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>