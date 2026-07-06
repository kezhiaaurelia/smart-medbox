<?php

namespace App\Console\Commands;

use App\Models\JadwalMinumObat;
use App\Models\RiwayatKepatuhan;
use Illuminate\Console\Command;

class GenerateRiwayatHarian extends Command
{
    protected $signature = 'riwayat:generate';
    protected $description = 'Generate riwayat kepatuhan untuk jadwal aktif hari ini';

    public function handle()
{
    $jadwals = JadwalMinumObat::with('jamMinums')->where('aktif', true)->get();
    $hariIni = now()->startOfDay();
    $jumlah = 0;

    foreach ($jadwals as $jadwal) {
        if (! $jadwal->jatuhTempoPada($hariIni)) {
            continue;
        }

        foreach ($jadwal->jamMinums as $jamMinum) {
            $sudahAda = RiwayatKepatuhan::where('jadwal_minum_obat_id', $jadwal->id)
                ->whereDate('tanggal', $hariIni->format('Y-m-d'))
                ->where('jam_seharusnya', $jamMinum->jam)
                ->exists();

            if (! $sudahAda) {
                RiwayatKepatuhan::create([
                    'user_id' => $jadwal->user_id,
                    'jadwal_minum_obat_id' => $jadwal->id,
                    'tanggal' => $hariIni->format('Y-m-d'),
                    'jam_seharusnya' => $jamMinum->jam,
                    'status' => 'tidak_diminum',
                ]);
                $jumlah++;
            }
        }
    }

    $this->info("Berhasil generate {$jumlah} riwayat baru untuk hari ini.");
}
}