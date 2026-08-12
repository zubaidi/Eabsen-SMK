<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresensiJam extends Model
{
    protected $fillable = [
        'presensi_id',
        'jam_pelajaran_id',
    ];

    public function presensi(): BelongsTo
    {
        return $this->belongsTo(Presensi::class);
    }

    public function jamPelajaran(): BelongsTo
    {
        return $this->belongsTo(JamPelajaran::class);
    }
}