@extends('layouts.dashboard')

@section('title', 'Data Obat - Smart-MedBox')
@section('page-title', 'Data Obat')

@section('content')

@if (session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Kelola daftar obat yang tersedia.</p>
    <a href="{{ route('obat.create') }}" class="btn btn-primary rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>Tambah Obat
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        @if ($obats->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-capsules fa-3x text-muted mb-3"></i>
                <h6 class="fw-bold">Belum ada data obat</h6>
                <p class="text-muted">Klik "Tambah Obat" untuk menambahkan data baru.</p>
            </div>
        @else
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nama Obat</th>
                        <th>Dosis</th>
                        <th>Keterangan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obat)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $obat->nama }}</td>
                            <td>{{ $obat->dosis ?? '-' }}</td>
                            <td>{{ $obat->keterangan ?? '-' }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('obat.edit', $obat) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('obat.destroy', $obat) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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