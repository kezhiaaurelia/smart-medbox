@extends('layouts.dashboard')

@section('title', 'Dashboard - Smart-MedBox')
@section('page-title', 'Dashboard')

@section('content')

<!-- Welcome -->
<div class="d-flex align-items-center gap-3 mb-4">
    <img src="{{ Auth::user()->foto_profil_url }}" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
    <div>
        <h4 class="fw-bold mb-1">Halo, {{ Auth::user()->name }} 👋</h4>
        <p class="text-muted mb-0">Berikut ringkasan jadwal minum obat Anda hari ini.</p>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary"><i class="fas fa-capsules"></i></div>
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
                <div class="stat-icon bg-success"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="text-muted small">Jadwal Aktif</div>
                    <div class="fs-4 fw-bold">{{ $totalJadwalAktif }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-info"><i class="fas fa-chart-pie"></i></div>
                <div>
                    <div class="text-muted small">Kepatuhan Minggu Ini</div>
                    <div class="fs-4 fw-bold">{{ $persentaseKepatuhan }}%</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-danger"><i class="fas fa-bell"></i></div>
                <div>
                    <div class="text-muted small">Alarm Terlewat Hari Ini</div>
                    <div class="fs-4 fw-bold">{{ $alarmTerlewatHariIni }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Jadwal Berikutnya -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h6 class="fw-bold mb-3"><i class="fas fa-bell text-primary me-2"></i>Jadwal Berikutnya</h6>
            @if ($jadwalBerikutnya)
                <div class="text-center py-3">
                    <div class="display-6 fw-bold text-primary">{{ $jadwalBerikutnya['jam']->format('H:i') }}</div>
                    <div class="fs-5 fw-semibold mt-2">{{ $jadwalBerikutnya['obat'] }}</div>
                    @if ($jadwalBerikutnya['keterangan'])
                        <div class="text-muted small">{{ $jadwalBerikutnya['keterangan'] }}</div>
                    @endif
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <p class="mb-0">Tidak ada jadwal lagi untuk hari ini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Jadwal Hari Ini (semua) -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h6 class="fw-bold mb-3"><i class="fas fa-list text-primary me-2"></i>Semua Jadwal Hari Ini</h6>
            @if ($jamHariIni->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-calendar-xmark fa-2x mb-2"></i>
                    <p class="mb-0">Belum ada jadwal minum obat untuk hari ini.</p>
                    <a href="{{ route('jadwal.create') }}" class="btn btn-sm btn-primary rounded-pill mt-2">
                        <i class="fas fa-plus me-1"></i> Tambah Jadwal
                    </a>
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($jamHariIni as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <span class="fw-semibold">{{ $item['obat'] }}</span>
                                @if ($item['keterangan'])
                                    <span class="text-muted small d-block">{{ $item['keterangan'] }}</span>
                                @endif
                            </div>
                            <span class="badge bg-primary rounded-pill px-3 py-2">{{ $item['jam']->format('H:i') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection