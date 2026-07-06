@extends('layouts.dashboard')

@section('title', 'Jadwal Minum Obat - Smart-MedBox')
@section('page-title', 'Jadwal Minum Obat')

@section('content')

@if (session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-warning rounded-3">{{ session('error') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Atur jadwal minum obat untuk setiap pasien.</p>
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>Tambah Jadwal
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        @if ($jadwals->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                <h6 class="fw-bold">Belum ada jadwal minum obat</h6>
                <p class="text-muted">Klik "Tambah Jadwal" untuk menambahkan jadwal baru.</p>
            </div>
        @else
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Pasien</th>
                        <th>Obat</th>
                        <th>Frekuensi</th>
                        <th>Jam Minum</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $jadwal->pasien->nama }}</td>
                            <td>{{ $jadwal->obat->nama }}</td>
                            <td>
                                <span class="badge bg-info-subtle text-info-emphasis rounded-pill px-3 py-2">
                                    {{ $jadwal->labelFrekuensi() }}
                                </span>
                            </td>
                            <td>
                                @foreach ($jadwal->jamMinums as $jam)
                                    <span class="badge bg-primary rounded-pill px-2 py-1 me-1">
                                        {{ \Carbon\Carbon::parse($jam->jam)->format('H:i') }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $jadwal->keterangan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('jadwal.toggle', $jadwal) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm rounded-pill {{ $jadwal->aktif ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $jadwal->aktif ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('jadwal.edit', $jadwal) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection