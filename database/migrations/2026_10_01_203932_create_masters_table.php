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
        Schema::create('masters', function (Blueprint $table) {

            // Primary Key
            $table->id('id_master');

            // Data Perguruan Tinggi
            // String agar kode seperti 031015 tetap memiliki angka 0 di depan
            $table->string('kode_pt', 20);

            $table->string('nama_pt');

            // Data Faswil
            $table->string('nama_faswil');

            // Nomor Meja
            $table->unsignedInteger('no_meja');

            // Sesi
            $table->string('sesi', 50);

            // Tanggal
            $table->date('tanggal');

            // Jam pelayanan
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // Pendamping
            $table->string('pendamping');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};