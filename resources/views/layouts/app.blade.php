<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart-MedBox')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #0d6efd;
        }

        .hero-section {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
            padding: 100px 0 80px;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1.5rem;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0d6efd;
        }

        footer {
            background: #1e293b;
            color: #cbd5e1;
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-capsules me-2"></i>Smart-MedBox
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stats">Statistik</a></li>
<li class="nav-item">
    <a class="nav-link btn btn-primary text-white px-4 ms-3" href="{{ route('login') }}">
        Login
    </a>
</li>                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <h5 class="fw-bold text-white mb-3"><i class="fas fa-capsules me-2"></i>Smart-MedBox</h5>
                    <p class="text-white-50">Solusi cerdas untuk manajemen obat pribadi maupun institusi kesehatan.
                        Pantau stok, jadwal minum, dan dapatkan pengingat otomatis.</p>
                    <div class="mt-3">
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="fw-bold text-white mb-3">Menu</h6>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Beranda</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Fitur</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Harga</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-white-50">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold text-white mb-3">Kontak</h6>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Kesehatan No. 123, Jakarta
                        </li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (021) 1234-5678</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@smartmedbox.id</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center text-white-50 small">
                &copy; {{ date('Y') }} Smart-MedBox. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
