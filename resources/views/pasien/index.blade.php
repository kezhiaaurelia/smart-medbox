@extends('layouts.dashboard')

@section('title', 'Data Pasien - Smart-MedBox')
@section('page-title', 'Data Pasien')

@section('content')

@if (session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Kelola data pasien yang Anda pantau.</p>
    <a href="{{ route('pasien.create') }}" class="btn btn-primary rounded-pill px-4">
        <i class="fas fa-plus me-2"></i>Tambah Pasien
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        @if ($pasiens->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-user-injured fa-3x text-muted mb-3"></i>
                <h6 class="fw-bold">Belum ada data pasien</h6>
                <p class="text-muted">Klik "Tambah Pasien" untuk menambahkan data baru.</p>
            </div>
        @else
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nama Pasien</th>
                        <th>Kontak Darurat</th>
                        <th>Catatan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $pasien->nama }}</td>
                            <td>{{ $pasien->kontak_darurat ?? '-' }}</td>
                            <td>{{ $pasien->catatan ?? '-' }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('pasien.edit', $pasien) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('pasien.destroy', $pasien) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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