<style>
    /* CSS Khusus Sidebar Student */
    #studentSidebar .nav-pills .nav-link.active,
    #studentSidebar .nav-pills .show > .nav-link {
        background-color: #fd7e14; /* Warna Orange Utama */
        color: #fff;
        box-shadow: 0 4px 6px rgba(253, 126, 20, 0.25);
    }

    #studentSidebar .nav-link {
        color: #495057;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        margin-bottom: 0.25rem;
        border-radius: 0.5rem;
    }

    #studentSidebar .nav-link:hover:not(.active) {
        background-color: #fff7ed;
        color: #c2410c;
        transform: translateX(3px);
    }

    #studentSidebar .nav-link i {
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        margin-right: 0.75rem;
    }

    /* Responsif Mobile */
    @media (max-width: 991.98px) {
        #studentSidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1045;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        #studentSidebar.show {
            transform: translateX(0);
        }
    }
</style>

<nav class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm" id="studentSidebar" 
     style="width: 280px; min-height: 100vh; height: 100vh; overflow-y: auto;">
    
    {{-- Header Sidebar: Logo & Identitas (Dinamis) --}}
    <div class="d-flex align-items-center mb-4 mt-2 px-2">
        {{-- LOGO ASLI (Dikembalikan) --}}
        <a href="{{ route('student.dashboard') }}" class="text-decoration-none">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas" 
                 style="height: 40px; width: auto; flex-shrink: 0;" class="me-2">
        </a>

        <div class="lh-1 overflow-hidden">
            <h6 class="mb-0 fw-bold text-dark text-truncate">Portal Layanan</h6>
            <small class="text-secondary fw-semibold text-truncate" style="font-size: 0.65rem; letter-spacing: 0.5px; text-transform: uppercase;">
                {{-- LOGIKA DINAMIS --}}
                @if(Auth::user()->role == 'public')
                    Masyarakat Umum
                @elseif(Auth::user()->role == 'lecturer')
                    Dosen / Tendik
                @else
                    Mahasiswa
                @endif
            </small>
        </div>
        
        {{-- Tombol Close Mobile --}}
        <button class="btn btn-sm btn-light text-danger ms-auto d-lg-none" id="sidebarMobileToggle">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <hr class="mt-0 mb-3 text-secondary opacity-10">

    {{-- Menu Navigasi --}}
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('student.dashboard') }}" 
               class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
               <i class="bi bi-grid-fill"></i> 
               <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.profile.index') }}" 
               class="nav-link {{ request()->routeIs('student.profile.*') ? 'active' : '' }}">
               <i class="bi bi-person-circle"></i> 
               <span>Profil Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.articles.index') }}" 
               class="nav-link {{ request()->routeIs('student.articles.*') ? 'active' : '' }}">
               <i class="bi bi-journal-text"></i> 
               <span>Artikel & Edukasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.reports.index') }}" 
               class="nav-link {{ request()->routeIs('student.reports.*') ? 'active' : '' }}">
               <i class="bi bi-file-earmark-text-fill"></i> 
               <span>Laporan Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.counseling.index') }}" 
               class="nav-link {{ request()->routeIs('student.counseling.*') ? 'active' : '' }}">
               <i class="bi bi-calendar-event-fill"></i> 
               <span>Jadwal Konseling</span>
            </a>
        </li>
    </ul>

    <hr class="text-secondary opacity-10 my-3">

    {{-- Tombol Logout --}}
    <div class="px-2 pb-3">
        <a href="{{ route('logout') }}" 
           class="btn btn-light text-danger border-0 w-100 d-flex align-items-center justify-content-center py-2 fw-semibold shadow-sm"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           style="background-color: #fee2e2;">
            <i class="bi bi-box-arrow-right me-2"></i> 
            <span>Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>

{{-- Overlay Gelap untuk Mobile --}}
<div class="d-lg-none" id="sidebarOverlay" 
     style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040; display: none;">
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("studentSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const closeBtn = document.getElementById("sidebarMobileToggle");
    const headerToggle = document.getElementById("headerSidebarToggle"); 

    function openSidebar() {
        sidebar.classList.add("show");
        if(overlay) overlay.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function closeSidebar() {
        sidebar.classList.remove("show");
        if(overlay) overlay.style.display = "none";
        document.body.style.overflow = "";
    }

    if(headerToggle) headerToggle.addEventListener("click", openSidebar);
    if(closeBtn) closeBtn.addEventListener("click", closeSidebar);
    if(overlay) overlay.addEventListener("click", closeSidebar);
});
</script>