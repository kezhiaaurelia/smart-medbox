<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obat extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'dosis',
        'keterangan',
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
