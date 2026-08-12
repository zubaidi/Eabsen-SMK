<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamPelajaran extends Model
{
    protected $fillable = [
        'jam_ke',
        'waktu_mulai',
        'waktu_selesai',
    ];

    // Kolom waktu akan diperlakukan sebagai string murni untuk jam (H:i:s)
    protected function casts(): array
    {
        return [
            'jam_ke' => 'integer',
        ];
    }
}