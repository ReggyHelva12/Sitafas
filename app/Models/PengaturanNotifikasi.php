<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanNotifikasi extends Model
{
    protected $table = 'pengaturan_notifikasi';

    protected $fillable = [
        'notifikasi_tiket_baru',
        'perubahan_status_tiket',
        'panggilan_antrean',
        'antrean_selesai',
        'notifikasi_sistem',
        'suara_panggilan',
        'email',
    ];

    protected $casts = [
        'notifikasi_tiket_baru' => 'boolean',
        'perubahan_status_tiket' => 'boolean',
        'panggilan_antrean' => 'boolean',
        'antrean_selesai' => 'boolean',
        'notifikasi_sistem' => 'boolean',
        'suara_panggilan' => 'boolean',
        'email' => 'boolean',
    ];
}