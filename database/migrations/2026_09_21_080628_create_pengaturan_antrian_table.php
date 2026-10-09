<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaturan_antrian', function (Blueprint $table) {

            $table->id('id_pengaturan');

            /*
            |--------------------------------------------------------------------------
            | Prefix Tiket
            | Contoh: A, B, C, PT, LLDIKTI
            |--------------------------------------------------------------------------
            */
            $table->string('prefix_tiket', 10)
                ->default('A');

            /*
            |--------------------------------------------------------------------------
            | Panjang Nomor
            | Contoh:
            | 3 = A001
            | 4 = A0001
            |--------------------------------------------------------------------------
            */
            $table->unsignedTinyInteger('panjang_nomor')
                ->default(3);

            /*
            |--------------------------------------------------------------------------
            | Reset Nomor Antrean Setiap Hari
            | 1 = aktif
            | 0 = tidak aktif
            |--------------------------------------------------------------------------
            */
            $table->boolean('reset_harian')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_antrian');
    }
};