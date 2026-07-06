@extends('layouts.app')

@section('title', 'Login - Smart-MedBox')

@section('content')
<section class="hero-section d-flex align-items-center" style="min-height: calc(100vh - 76px); padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">

                    <div class="text-center mb-4">
                        <i class="fas fa-capsules fa-2x text-primary mb-2"></i>
                        <h3 class="fw-bold">Masuk ke Smart-MedBox</h3>
                        <p class="text-muted">Kelola jadwal obat pasien Anda dengan mudah</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success rounded-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email"
                                   class="form-control rounded-3 py-2 @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus
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
                                   name="password" required autocomplete="current-password"
                                   placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" for="remember">
                                    Ingat saya
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>

                        @if (Route::has('register'))
                            <p class="text-center text-muted mt-4 mb-0">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar sekarang</a>
                            </p>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection