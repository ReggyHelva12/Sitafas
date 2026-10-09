<?php

namespace App\Models;

use App\Models\Registrasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tikets';

    protected $primaryKey = 'id_tiket';

    protected $fillable = [
        'id_registrasi',
        'tanggal_antrian',
        'nomor_tiket',
        'status',
        'waktu_daftar',
        'waktu_mulai',
        'waktu_selesai',
        'aksi_terakhir',
        'waktu_aksi',

        // TIMER
    'durasi_timer',
    'timer_berakhir',
    'jumlah_reset_timer',
    'status_timer',
    'timer_sisa',

    ];

    protected $casts = [
        'tanggal_antrian' => 'date',
        'waktu_daftar'  => 'datetime',
        'waktu_mulai'   => 'datetime',
        'waktu_selesai' => 'datetime',
        'timer_berakhir' => 'datetime',

        'durasi_timer' => 'integer',
        'timer_sisa' => 'integer',
        'jumlah_reset_timer' => 'integer',
        'waktu_aksi' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Registrasi
    |--------------------------------------------------------------------------
    */

    public function registrasi()
    {
        return $this->belongsTo(
            Registrasi::class,
            'id_registrasi',
            'id_registrasi'
        );
    }

}