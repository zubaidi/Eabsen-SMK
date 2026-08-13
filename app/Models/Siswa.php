<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    
    protected $fillable = [
        'kelas_id',
        'nis',
        'nisn',
        'nama',
        'jenis_kelamin',
        'foto',
        'status',
    ];

    /**
     * Relasi ke tabel kelas (Setiap siswa berada di 1 kelas)
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Relasi ke tabel presensi_details (Riwayat presensi siswa)
     */
    public function presensiDetails(): HasMany
    {
        return $this->hasMany(PresensiDetail::class);
    }

    /**
     * Relasi ke tabel pelanggaran_siswas (Riwayat pelanggaran siswa)
     */
    public function pelanggaranSiswas(): HasMany
    {
        return $this->hasMany(PelanggaranSiswa::class);
    }
}