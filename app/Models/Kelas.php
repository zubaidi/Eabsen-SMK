<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    // Mendefinisikan nama tabel secara eksplisit agar Laravel tidak keliru
    protected $table = 'kelas';

    protected $fillable = [
        'jurusan_id',
        'tingkat',
        'nama_kelas',
        'wali_kelas_id',
    ];

    /**
     * Relasi ke tabel jurusans (Setiap kelas dimiliki oleh 1 jurusan)
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Relasi ke tabel users sebagai Wali Kelas
     */
    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    /**
     * Relasi ke tabel siswas (Satu kelas memiliki banyak siswa)
     */
    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}