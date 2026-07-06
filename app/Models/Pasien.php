<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'kontak_darurat',
        'catatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalMinumObats()
    {
        return $this->hasMany(JadwalMinumObat::class);
    }
}
