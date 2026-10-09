<?php

namespace App\Models;

use App\Models\Registrasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $table = 'masters';

    protected $primaryKey = 'id_master';

    public $incrementing = true;

    protected $keyType = 'int';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'kode_pt',
        'nama_pt',
        'nama_faswil',
        'no_meja',
        'sesi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'pendamping',
    ];


    /*
    |--------------------------------------------------------------------------
    | CAST
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'tanggal' => 'date',
        'no_meja' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI REGISTRASI
    |--------------------------------------------------------------------------
    */

    public function registrasis()
    {
        return $this->hasMany(
            Registrasi::class,
            'id_master',
            'id_master'
        );
    }
}