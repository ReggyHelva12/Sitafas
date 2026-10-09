<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemanggilans', function (Blueprint $table) {
            $table->id('id_pemanggilan');

            $table->foreignId('id_tiket')
                ->constrained('tikets', 'id_tiket')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('id_petugas')
                ->constrained('petugas', 'id_petugas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('id_meja')
                ->constrained('mejas', 'id_meja')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->integer('nomor_panggilan');

            $table->dateTime('waktu_dipanggil');

            $table->enum('status', [
                'dipanggil',
                'terlayani',
                'terlewat'
            ])->default('dipanggil');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemanggilans');
    }
};