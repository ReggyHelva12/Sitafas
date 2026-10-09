<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('pengaturan_antrian', function (Blueprint $table) {

            $table->unsignedInteger('durasi_layanan')
                ->default(15)
                ->after('reset_harian');

        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::table('pengaturan_antrian', function (Blueprint $table) {

            $table->dropColumn('durasi_layanan');

        });
    }
};