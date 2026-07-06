@extends('layouts.dashboard')

@section('title', 'Tambah Obat - Smart-MedBox')
@section('page-title', 'Tambah Obat')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">

            <form method="POST" action="{{ route('obat.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Obat</label>
                    <input type="text" id="nama" name="nama"
                           class="form-control rounded-3 py-2 @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}" placeholder="Contoh: Paracetamol 500mg" required autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dosis" class="form-label fw-semibold">Dosis (opsional)</label>
                    <input type="text" id="dosis" name="dosis"
                           class="form-control rounded-3 py-2 @error('dosis') is-invalid @enderror"
                           value="{{ old('dosis') }}" placeholder="Contoh: 1 tablet">
                    @error('dosis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-semibold">Keterangan (opsional)</label>
                    <input type="text" id="keterangan" name="keterangan"
                           class="form-control rounded-3 py-2 @error('keterangan') is-invalid @enderror"
                           value="{{ old('keterangan') }}" placeholder="Contoh: Diminum sesudah makan">
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                    <a href="{{ route('obat.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection