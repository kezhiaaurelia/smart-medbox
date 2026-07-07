@extends('layouts.app')

@section('title', 'Smart-MedBox - Solusi Cerdas Manajemen Obat')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4">
                        <i class="fas fa-capsules me-2"></i> Inovasi Kesehatan Digital
                    </div>
                    <h1 class="display-4 fw-bold mb-4">
                        Kotak Obat Pintar<br>
                        <span class="text-primary">Untuk Kesehatan Anda</span>
                    </h1>
                    <p class="lead text-secondary mb-4">
                        Smart-MedBox membantu Anda mengelola stok obat, jadwal minum, dan pengingat otomatis.
                        Pantau dari mana saja melalui aplikasi mobile dan web.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="login" class="btn btn-primary btn-lg rounded-pill px-4">
                            <i class="fas fa-rocket me-2"></i>Coba Sekarang
                        </a>
                        <a href="#features" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                            <i class="fas fa-play-circle me-2"></i>Demo
                        </a>
                    </div>
                    <div class="mt-5 d-flex align-items-center gap-4 text-muted">
                        <div><i class="fas fa-check-circle text-primary me-2"></i> Gratis 30 Hari</div>
                        <div><i class="fas fa-check-circle text-primary me-2"></i> Tanpa Kartu Kredit</div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://placehold.co/600x400/e0f2fe/1e3a8a?text=Smart-MedBox+Device" alt="Smart MedBox"
                        class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary text-uppercase fw-semibold">Fitur Unggulan</span>
                <h2 class="display-6 fw-bold mt-2">Mengapa Smart-MedBox?</h2>
                <p class="lead text-muted">Semua yang Anda butuhkan untuk manajemen obat yang efisien</p>
            </div>
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-4 text-center">
                        <div class="feature-icon bg-primary mx-auto">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <h5 class="fw-bold">Monitoring Stok Real-time</h5>
                        <p class="text-muted">Pantau jumlah obat secara akurat dan dapatkan notifikasi saat stok menipis.
                        </p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-4 text-center">
                        <div class="feature-icon bg-success mx-auto">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h5 class="fw-bold">Pengingat Minum Obat</h5>
                        <p class="text-muted">Jadwal minum obat otomatis dengan alarm dan notifikasi push.</p>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-4 text-center">
                        <div class="feature-icon bg-info mx-auto">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold">Laporan Kepatuhan</h5>
                        <p class="text-muted">Lihat riwayat konsumsi obat dan tingkat kepatuhan pengguna.</p>
                    </div>
                </div>
                <!-- Feature 4 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-4 text-center">
                        <div class="feature-icon bg-warning mx-auto">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold">Keamanan Data</h5>
                        <p class="text-muted">Data medis terenkripsi dan hanya bisa diakses oleh pihak berwenang.</p>
                    </div>
                </div>
                <!-- Feature 5 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-4 text-center">
                        <div class="feature-icon bg-danger mx-auto">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5 class="fw-bold">Akses Multi-Platform</h5>
                        <p class="text-muted">Tersedia di smartphone Android/iOS dan dashboard web.</p>
                    </div>
                </div>
                <!-- Feature 6 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-4 text-center">
                        <div class="feature-icon bg-secondary mx-auto">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h5 class="fw-bold">Manajemen Multi-User</h5>
                        <p class="text-muted">Cocok untuk keluarga atau panti jompo dengan banyak pengguna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary text-uppercase fw-semibold">Cara Kerja</span>
                <h2 class="display-6 fw-bold mt-2">3 Langkah Mudah</h2>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="step-number mx-auto">1</div>
                    <h5 class="fw-bold">Isi Kotak Obat</h5>
                    <p class="text-muted">Masukkan obat ke dalam kompartemen yang telah disediakan.</p>
                </div>
                <div class="col-md-4">
                    <div class="step-number mx-auto">2</div>
                    <h5 class="fw-bold">Atur Jadwal</h5>
                    <p class="text-muted">Tentukan waktu minum obat melalui aplikasi.</p>
                </div>
                <div class="col-md-4">
                    <div class="step-number mx-auto">3</div>
                    <h5 class="fw-bold">Dapatkan Notifikasi</h5>
                    <p class="text-muted">Kotak akan berbunyi dan mengirim notifikasi sesuai jadwal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="counter" id="userCount">0</div>
                    <p class="lead">Pengguna Aktif</p>
                </div>
                <div class="col-md-3">
                    <div class="counter" id="deviceCount">0</div>
                    <p class="lead">Perangkat Terjual</p>
                </div>
                <div class="col-md-3">
                    <div class="counter" id="reminderCount">0</div>
                    <p class="lead">Pengingat Terkirim</p>
                </div>
                <div class="col-md-3">
                    <div class="counter" id="ratingCount">0</div>
                    <p class="lead">Rating Pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="display-6 fw-bold mb-3">Siap Memulai?</h2>
            <p class="lead text-muted mb-4">Bergabunglah dengan ribuan pengguna yang sudah merasakan manfaat Smart-MedBox.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                <i class="fas fa-user-plus me-2"></i>Daftar Gratis
            </a>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Counter animation
        function animateCounter(elementId, target, suffix = '') {
            let element = document.getElementById(elementId);
            if (!element) return;
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current) + suffix;
                }
            }, 30);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter('userCount', 1250);
                        animateCounter('deviceCount', 890);
                        animateCounter('reminderCount', 5430);
                        animateCounter('ratingCount', 4.8, ' / 5');
                        observer.disconnect();
                    }
                });
            }, {
                threshold: 0.5
            });

            const statsSection = document.getElementById('stats');
            if (statsSection) observer.observe(statsSection);
        });
    </script>
@endsection
