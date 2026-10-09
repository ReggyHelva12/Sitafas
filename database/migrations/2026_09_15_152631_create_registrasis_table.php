<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrasis', function (Blueprint $table) {
            $table->id('id_registrasi');

            $table->foreignId('id_faswil')
                ->constrained('faswils', 'id_faswil')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('id_peserta')
                ->constrained('pesertas', 'id_peserta')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->dateTime('tgl_registrasi');
            $table->string('kebutuhan', 255)->nullable();

            $table->enum('status', [
                'terdaftar',
                'diproses',
                'selesai',
                'dibatalkan'
            ])->default('terdaftar');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrasis');
    }
};