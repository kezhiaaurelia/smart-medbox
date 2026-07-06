<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalJamMinum extends Model
{
    protected $fillable = ['jadwal_minum_obat_id', 'jam'];

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalMinumObat::class, 'jadwal_minum_obat_id');
    }
}