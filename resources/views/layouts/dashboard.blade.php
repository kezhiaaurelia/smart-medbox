<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - Smart-MedBox')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #1e293b;
            width: 250px;
        }

        .sidebar .navbar-brand {
            color: #fff;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar .nav-link i {
            width: 20px;
        }

        .topbar {
            background: #fff;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            border-radius: 16px;
            border: none;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                z-index: 1050;
                transition: 0.3s;
            }

            .sidebar.show {
                left: 0;
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3" id="sidebar">
            <a href="{{ route('dashboard') }}" class="navbar-brand mb-4 px-2">
                <i class="fas fa-capsules me-2"></i>Smart-MedBox
            </a>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-gauge-high me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pasien.index') }}"
                        class="nav-link {{ request()->routeIs('pasien.*') ? 'active' : '' }}">
                        <i class="fas fa-user-injured me-2"></i> Data Pasien
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('obat.index') }}"
                        class="nav-link {{ request()->routeIs('obat.*') ? 'active' : '' }}">
                        <i class="fas fa-capsules me-2"></i> Data Obat
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jadwal.index') }}"
                        class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                        <i class="fas fa-clock me-2"></i> Jadwal Minum
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('riwayat.index') }}"
                        class="nav-link {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-line me-2"></i> Riwayat Kepatuhan
                    </a>
                </li>
            </ul>
            <hr class="text-secondary">
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <i class="fas fa-user-gear me-2"></i> Profil
            </a>
        </div>

        <!-- Main -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <nav class="topbar d-flex align-items-center justify-content-between px-4 py-3">
                <button class="btn btn-light d-md-none"
                    onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->foto_profil_url }}" class="rounded-circle me-2" width="38"
                            height="38" style="object-fit: cover;">
                        <span class="text-dark fw-semibold">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                    class="fas fa-user-gear me-2"></i>Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <div class="p-4">
                @yield('content')
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
