<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PelanggaranSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'jenis_pelanggaran_id',
        'tanggal_kejadian',
        'deskripsi',
        'poin',
        'dicatat_oleh',
        'status',
        'rencana_tindak_lanjut',
        'disetujui_oleh',
        'tanggal_persetujuan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kejadian' => 'date',
            'tanggal_persetujuan' => 'datetime',
            'poin' => 'integer',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jenisPelanggaran(): BelongsTo
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }

    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }

    public function penyetuju(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function tindakLanjut(): HasMany
    {
        return $this->hasMany(TindakLanjutPelanggaran::class, 'pelanggaran_id');
    }
}