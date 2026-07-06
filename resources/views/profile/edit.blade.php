@extends('layouts.dashboard')

@section('title', 'Profil - Smart-MedBox')
@section('page-title', 'Profil Saya')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success rounded-3">Profil berhasil diperbarui.</div>
        @endif
        @if (session('status') === 'password-updated')
            <div class="alert alert-success rounded-3">Password berhasil diperbarui.</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- 👤 Informasi Akun -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                <h5 class="fw-bold mb-4">👤 Informasi Akun</h5>

                <div class="text-center mb-4">
                    <img src="{{ $user->foto_profil_url }}" class="rounded-circle mb-2" width="100" height="100" style="object-fit: cover;">
                    <div>
                        <label for="foto_profil" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="fas fa-camera me-1"></i> Ganti Foto
                        </label>
                        <input type="file" id="foto_profil" name="foto_profil" accept="image/*" class="d-none">
                    </div>
                    @error('foto_profil')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" id="name" name="name"
                           class="form-control rounded-3 py-2 @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-control rounded-3 py-2 @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label for="no_hp" class="form-label fw-semibold">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp"
                           class="form-control rounded-3 py-2 @error('no_hp') is-invalid @enderror"
                           value="{{ old('no_hp', $user->no_hp) }}" placeholder="Contoh: 0812xxxxxxx">
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- 💊 Informasi Pasien -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                <h5 class="fw-bold mb-4">💊 Informasi Pasien</h5>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                           class="form-control rounded-3 py-2 @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ old('tanggal_lahir', optional($user->tanggal_lahir)->format('Y-m-d')) }}">
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L"
                                   {{ old('jenis_kelamin', $user->jenis_kelamin) === 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jk_l">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P"
                                   {{ old('jenis_kelamin', $user->jenis_kelamin) === 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jk_p">Perempuan</label>
                        </div>
                    </div>
                    @error('jenis_kelamin')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="golongan_darah" class="form-label fw-semibold">Golongan Darah</label>
                    <select id="golongan_darah" name="golongan_darah" class="form-select rounded-3 py-2 @error('golongan_darah') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach (['A', 'B', 'AB', 'O'] as $gol)
                            <option value="{{ $gol }}" {{ old('golongan_darah', $user->golongan_darah) === $gol ? 'selected' : '' }}>
                                {{ $gol }}
                            </option>
                        @endforeach
                    </select>
                    @error('golongan_darah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label for="riwayat_alergi" class="form-label fw-semibold">Riwayat Alergi (opsional)</label>
                    <textarea id="riwayat_alergi" name="riwayat_alergi" rows="2"
                              class="form-control rounded-3 @error('riwayat_alergi') is-invalid @enderror"
                              placeholder="Contoh: Alergi seafood, alergi penisilin">{{ old('riwayat_alergi', $user->riwayat_alergi) }}</textarea>
                    @error('riwayat_alergi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- 👨‍👩‍👧 Kontak Darurat -->
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                <h5 class="fw-bold mb-4">👨‍👩‍👧 Kontak Darurat</h5>

                <div class="mb-3">
                    <label for="kontak_darurat_nama" class="form-label fw-semibold">Nama</label>
                    <input type="text" id="kontak_darurat_nama" name="kontak_darurat_nama"
                           class="form-control rounded-3 py-2 @error('kontak_darurat_nama') is-invalid @enderror"
                           value="{{ old('kontak_darurat_nama', $user->kontak_darurat_nama) }}">
                    @error('kontak_darurat_nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="kontak_darurat_hubungan" class="form-label fw-semibold">Hubungan</label>
                    <input type="text" id="kontak_darurat_hubungan" name="kontak_darurat_hubungan"
                           class="form-control rounded-3 py-2 @error('kontak_darurat_hubungan') is-invalid @enderror"
                           value="{{ old('kontak_darurat_hubungan', $user->kontak_darurat_hubungan) }}" placeholder="Contoh: Anak, Suami, Istri">
                    @error('kontak_darurat_hubungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label for="kontak_darurat_hp" class="form-label fw-semibold">Nomor HP</label>
                    <input type="text" id="kontak_darurat_hp" name="kontak_darurat_hp"
                           class="form-control rounded-3 py-2 @error('kontak_darurat_hp') is-invalid @enderror"
                           value="{{ old('kontak_darurat_hp', $user->kontak_darurat_hp) }}">
                    @error('kontak_darurat_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-primary rounded-pill px-5">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- 🔐 Keamanan -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
            <h5 class="fw-bold mb-4">🔐 Keamanan</h5>

            <div class="d-flex gap-2 mb-4">
                <button type="button" class="btn btn-outline-primary rounded-pill px-4" data-bs-toggle="collapse" data-bs-target="#collapsePassword">
                    <i class="fas fa-key me-2"></i>Ubah Password
                </button>
            </div>

            <div class="collapse" id="collapsePassword">
                <hr>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                               class="form-control rounded-3 py-2 @error('current_password', 'updatePassword') is-invalid @enderror"
                               autocomplete="current-password">
                        @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password Baru</label>
                        <input type="password" id="password" name="password"
                               class="form-control rounded-3 py-2 @error('password', 'updatePassword') is-invalid @enderror"
                               autocomplete="new-password">
                        @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control rounded-3 py-2 @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                               autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i>Simpan Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 border-start border-danger border-4">
            <h5 class="fw-bold mb-1 text-danger"><i class="fas fa-triangle-exclamation me-2"></i>Hapus Akun</h5>
            <p class="text-muted mb-4">
                Setelah akun dihapus, semua data akan dihapus permanen dan tidak bisa dikembalikan.
            </p>
            <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalHapusAkun">
                <i class="fas fa-trash me-2"></i>Hapus Akun Saya
            </button>
        </div>

    </div>
</div>

<!-- Modal Hapus Akun -->
<div class="modal fade" id="modalHapusAkun" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Masukkan password untuk konfirmasi penghapusan akun.</p>
                    <input type="password" name="password"
                           class="form-control rounded-3 py-2 @error('password', 'userDeletion') is-invalid @enderror"
                           placeholder="Password Anda">
                    @error('password', 'userDeletion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Modal(document.getElementById('modalHapusAkun')).show();
        });
    </script>
@endif

@section('scripts')
<script>
    // Preview nama file foto yang dipilih (opsional, biar keliatan foto ganti)
    document.getElementById('foto_profil').addEventListener('change', function (e) {
        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (event) {
                document.querySelector('img.rounded-circle').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection

@endsection