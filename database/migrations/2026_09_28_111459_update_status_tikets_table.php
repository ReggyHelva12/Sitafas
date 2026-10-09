<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE tikets
            MODIFY COLUMN status ENUM(
                'menunggu',
                'dipanggil',
                'dilayani',
                'dilewati',
                'selesai'
            ) NULL DEFAULT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE tikets
            MODIFY COLUMN status ENUM(
                'menunggu',
                'dipanggil',
                'dilayani',
                'dilewati',
                'selesai'
            ) NULL DEFAULT NULL
        ");
    }
};