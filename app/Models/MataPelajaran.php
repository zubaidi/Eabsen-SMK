<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
    ];

    public function guruMapelKelas(): HasMany
    {
        return $this->hasMany(GuruMapelKelas::class, 'mapel_id');
    }
}