<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin-penjamu',
            'password' => Hash::make('penjamu123'),
            'role' => 'admin',
            'nama' => 'Admin Penjamu',
            'email' => 'admin@sitafas.test',
            'status' => 'aktif',
        ]);
    }
}