<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Panel Mahasiswa</title>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Vite (Laravel Mix) --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Custom Style --}}
    <style>
        /* Sidebar default */
        .sidebar {
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dee2e6;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        /* Minimized sidebar (desktop) */
        .sidebar.minimized {
            width: 80px;
        }
        .sidebar.minimized .sidebar-text {
            display: none;
        }
        .sidebar.minimized .nav-link {
            justify-content: center;
        }
        .sidebar.minimized .nav-link i {
            margin: 0;
        }

        /* Konten utama */
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.minimized ~ .main-content {
            margin-left: 80px;
        }

        /* Mobile - sidebar tersembunyi */
        @media (max-width: 992px) {
            .sidebar {
                left: -280px;
            }
            .sidebar.open {
                left: 0;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Overlay hitam untuk mobile */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1020;
            display: none;
        }
        .sidebar-overlay.show {
            display: block;
        }

    </style>
</head>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const desktopToggle = document.getElementById("desktopSidebarToggle");
    const mobileToggle = document.getElementById("headerSidebarToggle");
    const mobileClose = document.getElementById("sidebarMobileToggle");

    // === 1️⃣ Load state dari localStorage saat halaman dibuka ===
    const sidebarState = localStorage.getItem("sidebarState");
    if (sidebarState === "minimized") {
        sidebar.classList.add("minimized");
    } else if (sidebarState === "open") {
        sidebar.classList.add("open");
        overlay?.classList.add("show");
    }

    // === 2️⃣ Toggle sidebar (desktop minimize) ===
    desktopToggle?.addEventListener("click", () => {
        sidebar.classList.toggle("minimized");

        // Simpan state ke localStorage
        if (sidebar.classList.contains("minimized")) {
            localStorage.setItem("sidebarState", "minimized");
        } else {
            localStorage.setItem("sidebarState", "expanded");
        }
    });

    // === 3️⃣ Toggle sidebar (mobile buka) ===
    mobileToggle?.addEventListener("click", () => {
        sidebar.classList.add("open");
        overlay.classList.add("show");
        localStorage.setItem("sidebarState", "open");
    });

    // === 4️⃣ Tutup sidebar di mobile ===
    const closeSidebar = () => {
        sidebar.classList.remove("open");
        overlay.classList.remove("show");
        localStorage.setItem("sidebarState", "closed");
    };

    mobileClose?.addEventListener("click", closeSidebar);
    overlay?.addEventListener("click", closeSidebar);
});
</script>

<body>

    {{-- Sidebar --}}
    @include('partials.student_sidebar')

    {{-- Main Content Area --}}
    <div class="main-content d-flex flex-column">

        {{-- Header --}}
        @include('partials.panel_header')

        {{-- Content --}}
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.panel_footer')
    </div>

</body>
</html>
