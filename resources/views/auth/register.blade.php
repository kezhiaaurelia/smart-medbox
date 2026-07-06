@extends('layouts.auth')

@section('title', 'Daftar - Smart-MedBox')

@section('content')
<section class="hero-section d-flex align-items-center" style="min-height: calc(100vh - 76px); padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">

                    <div class="text-center mb-4">
                        <i class="fas fa-capsules fa-2x text-primary mb-2"></i>
                        <h3 class="fw-bold">Daftar Akun Smart-MedBox</h3>
                        <p class="text-muted">Mulai kelola jadwal obat pasien Anda</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input id="name" type="text"
                                   class="form-control rounded-3 py-2 @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Masukkan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email"
                                   class="form-control rounded-3 py-2 @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required
                                   placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password"
                                   class="form-control rounded-3 py-2 @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password"
                                   class="form-control rounded-3 py-2 @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="••••••••">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </button>

                        <p class="text-center text-muted mt-4 mb-0">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di sini</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection