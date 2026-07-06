@extends('layouts.dashboard')

@section('title', 'Edit Jadwal - Smart-MedBox')
@section('page-title', 'Edit Jadwal Minum Obat')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">

            <form method="POST" action="{{ route('jadwal.update', $jadwal) }}" id="formJadwal">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="pasien_id" class="form-label fw-semibold">Pasien</label>
                    <select id="pasien_id" name="pasien_id" class="form-select rounded-3 py-2 @error('pasien_id') is-invalid @enderror" required>
                        @foreach ($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ old('pasien_id', $jadwal->pasien_id) == $pasien->id ? 'selected' : '' }}>
                                {{ $pasien->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('pasien_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="obat_id" class="form-label fw-semibold">Obat</label>
                    <select id="obat_id" name="obat_id" class="form-select rounded-3 py-2 @error('obat_id') is-invalid @enderror" required>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}" {{ old('obat_id', $jadwal->obat_id) == $obat->id ? 'selected' : '' }}>
                                {{ $obat->nama }} @if($obat->dosis) ({{ $obat->dosis }}) @endif
                            </option>
                        @endforeach
                    </select>
                    @error('obat_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Frekuensi Minum</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe_frekuensi" id="tipe_setiap_hari" value="setiap_hari"
                                   {{ old('tipe_frekuensi', $jadwal->tipe_frekuensi) === 'setiap_hari' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tipe_setiap_hari">Setiap Hari</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe_frekuensi" id="tipe_interval" value="interval_hari"
                                   {{ old('tipe_frekuensi', $jadwal->tipe_frekuensi) === 'interval_hari' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tipe_interval">Interval Beberapa Hari</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 {{ old('tipe_frekuensi', $jadwal->tipe_frekuensi) === 'interval_hari' ? '' : 'd-none' }}" id="wrapperInterval">
                    <label for="interval_hari" class="form-label fw-semibold">Minum Setiap Berapa Hari?</label>
                    <input type="number" min="1" id="interval_hari" name="interval_hari"
                           class="form-control rounded-3 py-2 @error('interval_hari') is-invalid @enderror"
                           value="{{ old('interval_hari', $jadwal->interval_hari) }}">
                    @error('interval_hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                           class="form-control rounded-3 py-2 @error('tanggal_mulai') is-invalid @enderror"
                           value="{{ old('tanggal_mulai', $jadwal->tanggal_mulai->format('Y-m-d')) }}" required>
                    @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jam Minum (bisa lebih dari 1, misal 3x sehari)</label>
                    <div id="wrapperJam">
                        @forelse ($jadwal->jamMinums as $index => $jamMinum)
                            <div class="input-group mb-2">
                                <input type="time" name="jam[]" class="form-control rounded-start-3 py-2"
                                       value="{{ \Carbon\Carbon::parse($jamMinum->jam)->format('H:i') }}" required>
                                <button type="button" class="btn btn-outline-danger btnHapusJam" {{ $jadwal->jamMinums->count() === 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @empty
                            <div class="input-group mb-2">
                                <input type="time" name="jam[]" class="form-control rounded-start-3 py-2" required>
                                <button type="button" class="btn btn-outline-danger btnHapusJam" disabled><i class="fas fa-trash"></i></button>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" id="btnTambahJam" class="btn btn-sm btn-outline-primary rounded-pill mt-1">
                        <i class="fas fa-plus me-1"></i> Tambah Jam Lain
                    </button>
                    @error('jam.*')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-semibold">Keterangan (opsional)</label>
                    <input type="text" id="keterangan" name="keterangan"
                           class="form-control rounded-3 py-2 @error('keterangan') is-invalid @enderror"
                           value="{{ old('keterangan', $jadwal->keterangan) }}">
                    @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const radios = document.querySelectorAll('input[name="tipe_frekuensi"]');
    const wrapperInterval = document.getElementById('wrapperInterval');

    function toggleInterval() {
        const selected = document.querySelector('input[name="tipe_frekuensi"]:checked').value;
        wrapperInterval.classList.toggle('d-none', selected !== 'interval_hari');
    }
    radios.forEach(r => r.addEventListener('change', toggleInterval));

    const wrapperJam = document.getElementById('wrapperJam');
    document.getElementById('btnTambahJam').addEventListener('click', function () {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="time" name="jam[]" class="form-control rounded-start-3 py-2" required>
            <button type="button" class="btn btn-outline-danger btnHapusJam"><i class="fas fa-trash"></i></button>
        `;
        wrapperJam.appendChild(div);
        updateHapusButtons();
    });

    wrapperJam.addEventListener('click', function (e) {
        if (e.target.closest('.btnHapusJam')) {
            e.target.closest('.input-group').remove();
            updateHapusButtons();
        }
    });

    function updateHapusButtons() {
        const groups = wrapperJam.querySelectorAll('.input-group');
        groups.forEach(g => {
            g.querySelector('.btnHapusJam').disabled = groups.length === 1;
        });
    }
</script>
@endsection