<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalMinumObat extends Model
{
    protected $fillable = [
        'user_id',
        'pasien_id',
        'obat_id',
        'tipe_frekuensi',
        'interval_hari',
        'tanggal_mulai',
        'keterangan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tanggal_mulai' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class);
    }

    public function jamMinums(): HasMany
    {
        return $this->hasMany(JadwalJamMinum::class, 'jadwal_minum_obat_id')->orderBy('jam');
    }

    public function riwayatKepatuhans(): HasMany
    {
        return $this->hasMany(RiwayatKepatuhan::class, 'jadwal_minum_obat_id');
    }

    /**
     * Cek apakah jadwal ini jatuh tempo pada tanggal tertentu (untuk tipe interval_hari)
     */
    public function jatuhTempoPada(\Carbon\Carbon $tanggal): bool
    {
        if ($this->tipe_frekuensi === 'setiap_hari') {
            return true;
        }

        $selisihHari = $this->tanggal_mulai->diffInDays($tanggal);

        return $selisihHari % $this->interval_hari === 0;
    }

    public function labelFrekuensi(): string
    {
        if ($this->tipe_frekuensi === 'setiap_hari') {
            $jumlahJam = $this->jamMinums->count();
            return $jumlahJam > 1 ? "{$jumlahJam}x sehari" : '1x sehari';
        }

        return "Setiap {$this->interval_hari} hari sekali";
    }
}