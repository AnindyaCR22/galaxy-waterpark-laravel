<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galaxy Waterpark - Admin System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Lightbox2 CSS -->
    <link rel="stylesheet" href="{{ asset('lightbox2/dist/css/lightbox.min.css') }}">
    
    <!-- jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body class="bg-light">

    <!-- NAVBAR HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center text-nowrap" href="{{ route('home') }}">
                <img src="{{ asset('images/logoGalaxyWaterpark.jpg') }}" alt="Logo Galaxy Waterpark" height="35" class="me-2">
                Galaxy Waterpark
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navigation Menu Kiri -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white text-nowrap {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                                Dashboard
                            </a>
                        </li>

                        <!-- Pemisahan Menu Tiket Berdasarkan Role (RBAC) -->
                        @if(Auth::user()->level == 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-white text-nowrap {{ request()->routeIs('tiket.*') || request()->routeIs('galeri.tiket') ? 'active fw-bold' : '' }}" href="{{ route('tiket.index') }}">
                                    Data Tiket
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white text-nowrap {{ request()->routeIs('tiket.katalog') || request()->routeIs('galeri.tiket') ? 'active fw-bold' : '' }}" href="{{ route('tiket.katalog') }}">
                                    Katalog Tiket
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link text-white text-nowrap {{ request()->routeIs('gallery.*') ? 'active fw-bold' : '' }}" href="{{ route('gallery.index') }}">
                                Galeri Wahana
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white text-nowrap {{ request()->routeIs('jobs.*') ? 'active fw-bold' : '' }}" href="{{ route('jobs.index') }}">
                                Lowongan Kerja
                            </a>
                        </li>

                        <!-- Menu Khusus Admin (Middleware RBAC) -->
                        @if(Auth::user()->level == 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-white text-nowrap {{ request()->routeIs('users.*') ? 'active fw-bold' : '' }}" href="{{ route('users.index') }}">
                                    Kelola Users
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Navigation Status & Logout Kanan -->
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                        <li class="nav-item me-lg-3 mb-2 mb-lg-0 text-white text-nowrap">
                            <small>User: <strong>{{ Auth::user()->name }}</strong> 
                                @if(Auth::user()->level == 'admin')
                                    <span class="badge bg-danger ms-1">ADMIN</span>
                                @else
                                    <span class="badge bg-secondary ms-1">USER</span>
                                @endif
                            </small>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3 text-nowrap">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm rounded-pill px-3 text-nowrap" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="container mb-5">
        
        <!-- Flash Alert Message -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <strong>Akses Ditolak!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Content Kontainer Utama -->
        <div class="bg-white p-4 rounded shadow-sm">
            @yield('content')
        </div>
    </div>

    <!-- Script Inisialisasi Datepicker, Bootstrap & Lightbox2 -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lightbox2/dist/js/lightbox.min.js') }}"></script>
</body>
</html>