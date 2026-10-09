<?php

namespace App\Models;

use App\Models\Master;
use App\Models\Tiket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;

    protected $table = 'registrasis';

    protected $primaryKey = 'id_registrasi';

    public $incrementing = true;

    protected $keyType = 'int';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'id_master',
        'tgl_registrasi',
        'kebutuhan',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | CAST
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'tgl_registrasi' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI MASTER
    |--------------------------------------------------------------------------
    |
    | Registrasi mengambil:
    |
    | - Kode PT
    | - Nama PT
    | - Nama Faswil
    | - No Meja
    | - Sesi
    | - Tanggal
    | - Jam Mulai
    | - Jam Akhir
    | - Pendamping
    |
    */

    public function master()
    {
        return $this->belongsTo(
            Master::class,
            'id_master',
            'id_master'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI TIKET
    |--------------------------------------------------------------------------
    */

    public function tiket()
    {
        return $this->hasOne(
            Tiket::class,
            'id_registrasi',
            'id_registrasi'
        );
    }
}