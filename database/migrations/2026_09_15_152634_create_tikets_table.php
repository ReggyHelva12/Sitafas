<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id('id_tiket');

            $table->foreignId('id_registrasi')
                ->unique()
                ->constrained('registrasis', 'id_registrasi')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nomor_tiket', 20)->unique();

            $table->dateTime('waktu_daftar');
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};