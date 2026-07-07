<?php

use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\JadwalMinumObat;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JadwalMinumObatController;
use App\Http\Controllers\RiwayatKepatuhanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $userId = auth()->id();

    $totalPasien = Pasien::where('user_id', $userId)->count();

    $totalObat = Obat::where('user_id', $userId)->count();

    $totalJadwalAktif = JadwalMinumObat::where('user_id', $userId)
        ->where('aktif', true)
        ->count();

    // sementara
    $persentaseKepatuhan = 0;
    $alarmTerlewatHariIni = 0;

    $jadwalHariIni = collect();

    $jadwal = JadwalMinumObat::with(['obat', 'jamMinums'])
        ->where('user_id', $userId)
        ->where('aktif', true)
        ->get();

    foreach ($jadwal as $item) {

        if (!$item->jatuhTempoPada(today())) {
            continue;
        }

        foreach ($item->jamMinums as $jam) {

            $jadwalHariIni->push([
                'obat' => $item->obat->nama,
                'jam' => Carbon::parse($jam->jam),
                'keterangan' => $item->keterangan,
            ]);
        }
    }

    $jamHariIni = $jadwalHariIni->sortBy('jam')->values();

    $jadwalBerikutnya = $jamHariIni
        ->first(fn($j) => $j['jam']->greaterThan(now()));

    return view('dashboard', compact(
        'totalPasien',
        'totalObat',
        'totalJadwalAktif',
        'persentaseKepatuhan',
        'alarmTerlewatHariIni',
        'jadwalBerikutnya',
        'jamHariIni'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('pasien', PasienController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('jadwal', JadwalMinumObatController::class);
    Route::patch('/jadwal/{jadwal}/toggle', [JadwalMinumObatController::class, 'toggle'])->name('jadwal.toggle');
    Route::get('/riwayat', [RiwayatKepatuhanController::class, 'index'])->name('riwayat.index');
    Route::patch('/riwayat/{riwayat}/diminum', [RiwayatKepatuhanController::class, 'tandaiDiminum'])->name('riwayat.diminum');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__ . '/auth.php';
