<style>
    /* CSS Khusus untuk Mengubah Warna Active jadi Orange */
    #studentSidebar .nav-pills .nav-link.active,
    #studentSidebar .nav-pills .show > .nav-link {
        background-color: #fd7e14; /* Warna Orange Utama */
        color: #fff; /* Teks Putih */
    }

    /* Warna Link saat tidak aktif */
    #studentSidebar .nav-link {
        color: #343a40; /* Abu-abu gelap */
        font-weight: 500;
        transition: all 0.3s;
    }

    /* Efek saat mouse diarahkan (Hover) */
    #studentSidebar .nav-link:hover:not(.active) {
        background-color: #fff3cd; /* Warna kuning/orange muda sekali */
        color: #fd7e14; /* Teks jadi orange */
        transform: translateX(5px); /* Efek geser sedikit ke kanan */
    }

    /* Ikon di sidebar */
    #studentSidebar .nav-link i {
        font-size: 1.1rem;
        vertical-align: text-bottom;
    }
</style>

<nav class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm" id="studentSidebar" style="width: 280px; min-height: 100vh;">
    
    {{-- Logo + Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 px-2">
        <a href="{{ route('student.dashboard') }}" class="d-flex align-items-center text-decoration-none text-dark">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px; width: auto;">
            <div class="ms-2 lh-1 sidebar-text">
                <span class="fs-6 fw-bold text-uppercase ls-1">Portal Mhs</span><br>
                <span class="text-muted" style="font-size: 0.75rem;">PPKPT PNP</span>
            </div>
        </a>
        
        {{-- Tombol Close untuk Mobile --}}
        <button class="btn btn-sm btn-light border d-lg-none text-danger" id="sidebarMobileToggle">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    {{-- Tombol Toggle Desktop (Opsional, jika fitur collapse aktif) --}}
    {{-- <div class="px-2 mb-3 d-none d-lg-block">
        <button class="btn btn-sm btn-outline-secondary w-100" id="desktopSidebarToggle">
            <i class="bi bi-layout-sidebar-inset me-2"></i> Kecilkan Menu
        </button>
    </div> --}}

    <hr class="mt-0 mb-3 text-secondary opacity-25">

    {{-- Menu Navigasi --}}
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <li class="nav-item">
            <a href="{{ route('student.dashboard') }}" 
               class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
               <i class="bi bi-grid-fill me-3"></i> 
               <span class="sidebar-text">Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.profile.index') }}" 
               class="nav-link {{ request()->routeIs('student.profile.*') ? 'active' : '' }}">
               <i class="bi bi-person-circle me-3"></i> 
               <span class="sidebar-text">Profil Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.articles.index') }}" 
               class="nav-link {{ request()->routeIs('student.articles.*') ? 'active' : '' }}">
               <i class="bi bi-journal-text me-3"></i> 
               <span class="sidebar-text">Artikel & Edukasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.reports.index') }}" 
               class="nav-link {{ request()->routeIs('student.reports.*') ? 'active' : '' }}">
               <i class="bi bi-file-earmark-text-fill me-3"></i> 
               <span class="sidebar-text">Laporan Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student.counseling.index') }}" 
               class="nav-link {{ request()->routeIs('student.counseling.*') ? 'active' : '' }}">
               <i class="bi bi-calendar-event-fill me-3"></i> 
               <span class="sidebar-text">Jadwal Konseling</span>
            </a>
        </li>
    </ul>

    <hr class="text-secondary opacity-25">

    {{-- Tombol Logout --}}
    <div class="px-2">
        <a href="{{ route('logout') }}" 
           class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> 
            <span class="sidebar-text fw-bold">Keluar</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>

{{-- Overlay untuk mobile --}}
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 998; display: none;"></div>

{{-- Script Toggle --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("studentSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const toggleBtn = document.getElementById("sidebarMobileToggle");
    const headerToggle = document.getElementById("headerSidebarToggle");

    function openSidebar() {
        sidebar.classList.add("show"); // Pastikan CSS .show mengatur transform/display
        // Jika pakai bootstrap offcanvas logic manual:
        sidebar.style.transform = "translateX(0)";
        if(overlay) overlay.style.display = "block";
    }

    function closeSidebar() {
        sidebar.classList.remove("show");
        sidebar.style.transform = "translateX(-100%)"; // Sembunyikan ke kiri
        if(overlay) overlay.style.display = "none";
    }

    // Event Listeners
    if(headerToggle) headerToggle.addEventListener("click", openSidebar);
    if(toggleBtn) toggleBtn.addEventListener("click", closeSidebar);
    if(overlay) overlay.addEventListener("click", closeSidebar);
});
</script>