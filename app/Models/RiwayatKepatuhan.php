<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatKepatuhan extends Model
{
    protected $fillable = [
        'user_id',
        'jadwal_minum_obat_id',
        'tanggal',
        'jam_seharusnya',
        'jam_diminum',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalMinumObat::class, 'jadwal_minum_obat_id');
    }
}