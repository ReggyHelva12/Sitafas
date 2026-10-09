<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE registrasis
            MODIFY COLUMN status ENUM(
                'terdaftar',
                'diproses',
                'dilewati',
                'selesai',
                'dibatalkan'
            ) NOT NULL DEFAULT 'terdaftar'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE registrasis
            MODIFY COLUMN status ENUM(
                'terdaftar',
                'diproses',
                'selesai',
                'dibatalkan'
            ) NOT NULL DEFAULT 'terdaftar'
        ");
    }
};