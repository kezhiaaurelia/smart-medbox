@extends('layouts.dashboard')

@section('title', 'Riwayat Kepatuhan - Smart-MedBox')
@section('page-title', 'Riwayat Kepatuhan')

@section('content')

@if (session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
@endif

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success"><i class="fas fa-check"></i></div>
                <div>
                    <div class="text-muted small">Tepat Waktu</div>
                    <div class="fs-4 fw-bold">{{ $totalTepatWaktu }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="text-muted small">Terlambat</div>
                    <div class="fs-4 fw-bold">{{ $totalTerlambat }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-danger"><i class="fas fa-times"></i></div>
                <div>
                    <div class="text-muted small">Tidak Diminum</div>
                    <div class="fs-4 fw-bold">{{ $totalTidakDiminum }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <form method="GET" action="{{ route('riwayat.index') }}" class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label small fw-semibold mb-1">Filter Pasien</label>
            <select name="pasien_id" class="form-select rounded-3">
                <option value="">Semua Pasien</option>
                @foreach ($pasiens as $pasien)
                    <option value="{{ $pasien->id }}" {{ request('pasien_id') == $pasien->id ? 'selected' : '' }}>
                        {{ $pasien->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-semibold mb-1">Filter Tanggal</label>
            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ request('tanggal') }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-filter me-2"></i>Filter
            </button>
            <a href="{{ route('riwayat.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Reset</a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        @if ($riwayats->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                <h6 class="fw-bold">Belum ada riwayat kepatuhan</h6>
                <p class="text-muted">Riwayat akan muncul otomatis setiap hari sesuai jadwal minum obat aktif.</p>
            </div>
        @else
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Pasien</th>
                        <th>Obat</th>
                        <th>Jam Seharusnya</th>
                        <th>Jam Diminum</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayats as $riwayat)
                        <tr>
                            <td class="ps-4">{{ $riwayat->tanggal->format('d M Y') }}</td>
                            <td class="fw-semibold">{{ $riwayat->jadwal->pasien->nama }}</td>
                            <td>{{ $riwayat->jadwal->obat->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($riwayat->jam_seharusnya)->format('H:i') }}</td>
                            <td>
                                {{ $riwayat->jam_diminum ? \Carbon\Carbon::parse($riwayat->jam_diminum)->format('H:i') : '-' }}
                            </td>
                            <td>
                                @if ($riwayat->status === 'tepat_waktu')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Tepat Waktu</span>
                                @elseif ($riwayat->status === 'terlambat')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Terlambat</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Tidak Diminum</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if ($riwayat->status === 'tidak_diminum')
                                    <form action="{{ route('riwayat.diminum', $riwayat) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill">
                                            <i class="fas fa-check me-1"></i>Tandai Diminum
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection