@extends('layouts.dashboard')

@section('title', 'Tambah Pasien - Smart-MedBox')
@section('page-title', 'Tambah Pasien')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">

            <form method="POST" action="{{ route('pasien.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Pasien</label>
                    <input type="text" id="nama" name="nama"
                           class="form-control rounded-3 py-2 @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}" placeholder="Masukkan nama pasien" required autofocus>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kontak_darurat" class="form-label fw-semibold">Kontak Darurat (opsional)</label>
                    <input type="text" id="kontak_darurat" name="kontak_darurat"
                           class="form-control rounded-3 py-2 @error('kontak_darurat') is-invalid @enderror"
                           value="{{ old('kontak_darurat') }}" placeholder="Contoh: 0812xxxxxxx">
                    @error('kontak_darurat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="catatan" class="form-label fw-semibold">Catatan (opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3"
                              class="form-control rounded-3 @error('catatan') is-invalid @enderror"
                              placeholder="Contoh: riwayat alergi, kondisi khusus, dll">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                    <a href="{{ route('pasien.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection