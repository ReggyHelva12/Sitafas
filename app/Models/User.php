<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel
     */
    protected $table = 'users';

    /**
     * Primary key
     */
    protected $primaryKey = 'id_user';

    /**
     * Primary key bukan auto increment?
     * Karena $table->id() menggunakan auto increment,
     * maka tetap true.
     */
    public $incrementing = true;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Kolom yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'nama',
        'email',
        'status',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}