<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Akademik')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <nav class="topbar navbar navbar-expand-lg">
            <div class="container-xl">
                <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('dashboard') }}">
                    <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
                    <div class="brand-text-wrap">
                        <span class="brand-name">Sistem Akademik</span>
                        <span class="brand-subtitle">Portal Akademik Universitas</span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-grid-1x2-fill me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}" href="{{ route('prodi.index') }}">
                                <i class="bi bi-diagram-3-fill me-1"></i> Program Studi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                                <i class="bi bi-people-fill me-1"></i> Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mata_kuliah.*') ? 'active' : '' }}" href="{{ route('mata_kuliah.index') }}">
                                <i class="bi bi-journal-bookmark-fill me-1"></i> Mata Kuliah
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content">
            <div class="page-shell">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger modern-alert" role="alert">
                        <div class="fw-semibold mb-1">Periksa kembali data yang dimasukkan.</div>
                        <ul class="mb-0 ps-3">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="site-footer">
            <div class="container-xl footer-inner">
                <div>
                    <div class="footer-brand">SISTEM AKADEMIK</div>
                    <p class="footer-text">Platform pengelolaan data akademik untuk mendukung operasional dan informasi kampus secara terintegrasi.</p>
                </div>

                <div>
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('prodi.index') }}">Program Studi</a></li>
                        <li><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
                        <li><a href="{{ route('mata_kuliah.index') }}">Mata Kuliah</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright-bar">
                © 2026 Sistem Akademik. All Rights Reserved.
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.search-input').forEach(function (input) {
                const selector = input.dataset.searchTarget;
                if (!selector) return;

                const items = document.querySelectorAll(selector);

                input.addEventListener('input', function () {
                    const query = this.value.trim().toLowerCase();

                    items.forEach(function (item) {
                        const text = (item.dataset.searchText || item.textContent || '').toLowerCase();
                        item.style.display = text.includes(query) ? '' : 'none';
                    });
                });
            });

            document.querySelectorAll('.image-upload').forEach(function (input) {
                const previewId = input.dataset.previewId;
                if (!previewId) return;

                const preview = document.getElementById(previewId);
                if (!preview) return;

                input.addEventListener('change', function (event) {
                    const file = event.target.files && event.target.files[0];
                    if (!file) return;

                    const url = URL.createObjectURL(file);
                    preview.src = url;
                    preview.parentElement.classList.add('has-image');
                });
            });
        });
    </script>
</body>
</html>
