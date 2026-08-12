<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BkKelas extends Model
{
    protected $fillable = [
        'bk_user_id',
        'kelas_id',
    ];

    public function bkUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bk_user_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }
}