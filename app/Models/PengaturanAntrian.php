<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAntrian extends Model
{
    /**
     * Nama tabel
     */
    protected $table = 'pengaturan_antrian';

    /**
     * Primary Key
     */
    protected $primaryKey = 'id_pengaturan';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'prefix_tiket',
        'panjang_nomor',
        'reset_harian',
        'durasi_layanan',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'panjang_nomor' => 'integer',
        'reset_harian' => 'boolean',
        'durasi_layanan' => 'integer',
    ];
}