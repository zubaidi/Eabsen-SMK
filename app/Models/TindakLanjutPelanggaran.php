<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TindakLanjutPelanggaran extends Model
{
    protected $fillable = [
        'pelanggaran_id',
        'oleh_user_id',
        'catatan',
        'status_baru',
    ];

    public function pelanggaran(): BelongsTo
    {
        return $this->belongsTo(PelanggaranSiswa::class, 'pelanggaran_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'oleh_user_id');
    }
}