<style>
    /* CSS Khusus Sidebar Admin (Sama dengan Student) */
    #adminSidebar .nav-pills .nav-link.active,
    #adminSidebar .nav-pills .show > .nav-link {
        background-color: #fd7e14; /* Warna Orange Utama */
        color: #fff;
    }

    #adminSidebar .nav-link {
        color: #343a40;
        font-weight: 500;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem; /* Padding lebih lega */
        border-radius: 0.5rem;
    }

    #adminSidebar .nav-link:hover:not(.active) {
        background-color: #fff3cd;
        color: #fd7e14;
        transform: translateX(5px);
    }

    #adminSidebar .nav-link i {
        font-size: 1.2rem;
        margin-right: 0.75rem;
    }
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm" 
     id="adminSidebar" 
     style="width: 280px; height: 100vh; position: fixed; overflow-y: auto;">
    
    {{-- Header Logo --}}
    <a href="{{ route('admin.dashboard') }}" 
       class="d-flex align-items-center mb-4 mt-2 px-2 link-dark text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas" style="height: 45px; width: auto;">
        <div class="ms-3 lh-1">
            <span class="fs-5 fw-bold text-dark tracking-tight">Satgas PPKPT</span><br>
            <span class="text-muted small text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Admin Panel</span>
        </div>
    </a>
    
    <hr class="text-secondary opacity-25 mt-0 mb-3">

    {{-- Menu Navigasi --}}
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> 
                Beranda
            </a>
        </li>

        <li class="nav-item mt-3 mb-1 text-muted small fw-bold text-uppercase px-3">Konten & Data</li>

        <li>
            <a href="{{ route('admin.articles.index') }}" 
               class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="bi bi-journal-richtext"></i> 
                Artikel
            </a>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}" 
               class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-hdd-stack-fill"></i> 
                Layanan
            </a>
        </li>

        <li class="nav-item mt-3 mb-1 text-muted small fw-bold text-uppercase px-3">Pengguna</li>

        <li>
            <a href="{{ route('admin.counselors.index') }}" 
               class="nav-link {{ request()->routeIs('admin.counselors.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge-fill"></i> 
                Konselor
            </a>
        </li>
        <li>
            <a href="{{ route('admin.students.index') }}" 
               class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> 
                Mahasiswa
            </a>
        </li>

        <li class="nav-item mt-3 mb-1 text-muted small fw-bold text-uppercase px-3">Aktivitas</li>

        <li>
            <a href="{{ route('admin.reports.index') }}" 
               class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon-fill"></i> 
                Laporan Masuk
            </a>
        </li>
        <li>
            <a href="{{ route('admin.schedules.index') }}" 
               class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check-fill"></i> 
                Jadwal Konseling
            </a>
        </li>
    </ul>
    
    <hr class="text-secondary opacity-25 my-3">

    {{-- Tombol Keluar --}}
    <div class="px-2 pb-3">
        <a href="{{ route('logout') }}" 
           class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center py-2"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2 fs-5"></i>
            <span class="fw-bold">Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>