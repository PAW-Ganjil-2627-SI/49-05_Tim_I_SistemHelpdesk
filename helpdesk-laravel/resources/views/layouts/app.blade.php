<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IT Helpdesk System')</title>
    <!-- Bootstrap 5.3 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body>

    <div class="d-flex">
        <!-- =======================================================
         SIDEBAR DESKTOP
         ======================================================= -->
        <aside class="sidebar-github d-none d-lg-flex flex-column flex-shrink-0">
            <div class="sidebar-brand">
                <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2">
                    <i class="bi bi-shield-lock-fill text-gold fs-4"></i>
                    <div>
                        <span class="fw-bold text-white d-block lh-1">IT Helpdesk</span>
                        <small class="text-gold" style="font-size: 0.72rem;">Support & Asset System</small>
                    </div>
                </a>
            </div>

            <div class="sidebar-heading">Menu Utama</div>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">4 Modul Otonom</div>
            <ul class="nav flex-column mb-auto">
                <!-- Individu A -->
                <li class="nav-item">
                    <a href="{{ Route::has('kategori.index') ? route('kategori.index') : '#' }}"
                        class="nav-link @yield('menu-kategori')">
                        <i class="bi bi-tags"></i>
                        <span>Kategori Masalah IT</span>
                    </a>
                </li>

                <!-- Individu B -->
                <li class="nav-item">
                    <a href="{{ Route::has('teknisi.index') ? route('teknisi.index') : '#' }}"
                        class="nav-link @yield('menu-teknisi')">
                        <i class="bi bi-person-badge"></i>
                        <span>Teknisi & Support Staff</span>
                    </a>
                </li>

                <!-- Individu C (FAQ) -->
                <li class="nav-item">
                <li class="nav-item">
                    <a href="{{ Route::has('faq.daftar') ? route('faq.daftar') : '#' }}"
                        class="nav-link @yield('menu-faq')">
                        <i class="bi bi-journal-text"></i>
                        <span>Knowledge Base / FAQ</span>
                    </a>
                </li>

                <!-- Individu D -->
                <li class="nav-item">
                    <a href="{{ Route::has('aset.index') ? route('aset.index') : '#' }}"
                        class="nav-link @yield('menu-aset')">
                        <i class="bi bi-pc-display"></i>
                        <span>Departemen & Aset PC</span>
                    </a>
                </li>
            </ul>

            <div class="p-3 border-top border-secondary text-github-muted small">
                <i class="bi bi-people-fill text-gold me-1"></i> Kelompok Studi Kasus 12
            </div>
        </aside>

        <!-- =======================================================
         SIDEBAR MOBILE
         ======================================================= -->
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header border-bottom border-secondary">
                <h5 class="offcanvas-title fw-bold text-gold">
                    <i class="bi bi-shield-lock-fill me-1"></i> IT Helpdesk
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0 sidebar-github w-100 border-0">
                <div class="sidebar-heading">Menu Utama</div>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                </ul>
                <div class="sidebar-heading">4 Modul Otonom</div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link @yield('menu-kategori')"><i class="bi bi-tags"></i>
                            Kategori Masalah IT</a></li>
                    <li class="nav-item"><a href="#" class="nav-link @yield('menu-teknisi')"><i
                                class="bi bi-person-badge"></i> Teknisi & Support Staff</a></li>
                    <li class="nav-item"><a href="#" class="nav-link @yield('menu-faq')"><i
                                class="bi bi-journal-text"></i> Knowledge Base / FAQ</a></li>
                    <li class="nav-item"><a href="#" class="nav-link @yield('menu-aset')"><i
                                class="bi bi-pc-display"></i> Departemen & Aset PC</a></li>
                </ul>
            </div>
        </div>

        <!-- =======================================================
         AREA KANAN (TOPBAR + KONTEN UTAMA)
         ======================================================= -->
        <div class="flex-grow-1 d-flex flex-column min-vh-100">
            <!-- Top Navbar -->
            <header class="topbar-github d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-warning btn-sm d-lg-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#mobileSidebar">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <span class="fw-semibold text-white">@yield('topbar-title', 'Portal Layanan IT')</span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    @auth
                    <span class="badge bg-dark border border-secondary text-gold py-2 px-3">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ Auth::user()->username }} ({{ Auth::user()->role ?? 'user' }})
                    </span>
                    <form action="{{ Route::has('logout') ? route('logout') : '#' }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                    @else
                    <a href="{{ Route::has('login') ? route('login') : '#' }}"
                        class="btn btn-sm btn-outline-light">Login</a>
                    <a href="{{ Route::has('register') ? route('register') : '#' }}"
                        class="btn btn-sm btn-custom-gold">Daftar Akun</a>
                    @endauth
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="container-fluid p-4 flex-grow-1">
                @include('partials.alerts')
                @yield('content')
            </main>

            <!-- Footer kalau mau ditambahin boleh-->

        </div>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>