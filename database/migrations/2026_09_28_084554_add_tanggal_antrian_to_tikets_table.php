<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tikets', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | TAMBAH TANGGAL ANTREAN
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_antrian')
                ->after('nomor_tiket');


            /*
            |--------------------------------------------------------------------------
            | HAPUS UNIQUE NOMOR TIKET LAMA
            |--------------------------------------------------------------------------
            */

            $table->dropUnique(
                'tikets_nomor_tiket_unique'
            );


            /*
            |--------------------------------------------------------------------------
            | UNIQUE PER HARI
            |--------------------------------------------------------------------------
            */

            $table->unique(
                [
                    'tanggal_antrian',
                    'nomor_tiket'
                ],
                'tikets_tanggal_nomor_unique'
            );

        });
    }


    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {

            $table->dropUnique(
                'tikets_tanggal_nomor_unique'
            );

            $table->unique(
                'nomor_tiket',
                'tikets_nomor_tiket_unique'
            );

            $table->dropColumn(
                'tanggal_antrian'
            );

        });
    }
};