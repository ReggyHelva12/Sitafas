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
        Schema::table('registrasis', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Hapus Foreign Key lama
            |--------------------------------------------------------------------------
            */

            if (Schema::hasColumn('registrasis', 'id_jadwal')) {
                $table->dropForeign(['id_jadwal']);
            }

            if (Schema::hasColumn('registrasis', 'id_faswil')) {
                $table->dropForeign(['id_faswil']);
            }

            if (Schema::hasColumn('registrasis', 'id_pt')) {
                $table->dropForeign(['id_pt']);
            }

            /*
            |--------------------------------------------------------------------------
            | Tambahkan id_master sebagai Foreign Key
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('registrasis', 'id_master')) {

                $table->unsignedBigInteger('id_master')
                    ->nullable()
                    ->after('id_registrasi');

                $table->foreign('id_master')
                    ->references('id_master')
                    ->on('masters')
                    ->nullOnDelete();
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Hapus kolom lama
        |--------------------------------------------------------------------------
        */

        Schema::table('registrasis', function (Blueprint $table) {

            if (Schema::hasColumn('registrasis', 'id_jadwal')) {
                $table->dropColumn('id_jadwal');
            }

            if (Schema::hasColumn('registrasis', 'id_faswil')) {
                $table->dropColumn('id_faswil');
            }

            if (Schema::hasColumn('registrasis', 'id_pt')) {
                $table->dropColumn('id_pt');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrasis', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Hapus Foreign Key id_master
            |--------------------------------------------------------------------------
            */

            if (Schema::hasColumn('registrasis', 'id_master')) {

                $table->dropForeign(['id_master']);

                $table->dropColumn('id_master');
            }

            /*
            |--------------------------------------------------------------------------
            | Kembalikan kolom lama
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('id_jadwal')
                ->nullable();

            $table->unsignedBigInteger('id_faswil')
                ->nullable();

            $table->unsignedBigInteger('id_pt')
                ->nullable();
        });
    }
};