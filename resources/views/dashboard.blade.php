@extends('layouts.dashboard')

@section('title', 'Dashboard - Smart-MedBox')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Welcome -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->name }} 👋</h4>
        <p class="text-muted">Berikut ringkasan aktivitas Smart-MedBox Anda hari ini.</p>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary"><i class="fas fa-user-injured"></i></div>
                    <div>
                        <div class="text-muted small">Total Pasien</div>
                        <div class="fs-4 fw-bold">{{ $totalPasien }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success"><i class="fas fa-capsules"></i></div>
                    <div>
                        <div class="text-muted small">Total Obat</div>
                        <div class="fs-4 fw-bold">{{ $totalObat }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="text-muted small">Jadwal Hari Ini</div>
                        <div class="fs-4 fw-bold">{{ $totalJadwal }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger"><i class="fas fa-bell"></i></div>
                    <div>
                        <div class="text-muted small">Alarm Terlewat</div>
                        <div class="fs-4 fw-bold">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
        <h5 class="fw-bold">Belum Ada Data</h5>
        <p class="text-muted mb-4">Mulai dengan menambahkan data pasien dan jadwal minum obat.</p>
        <div>
            <a href="#" class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-plus me-2"></i>Tambah Pasien
            </a>
        </div>
    </div>

@endsection
