<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_notifikasi', function (Blueprint $table) {
            $table->id();

            $table->boolean('notifikasi_tiket_baru')
                ->default(true);

            $table->boolean('perubahan_status_tiket')
                ->default(true);

            $table->boolean('panggilan_antrean')
                ->default(true);

            $table->boolean('antrean_selesai')
                ->default(false);

            $table->boolean('notifikasi_sistem')
                ->default(true);

            $table->boolean('suara_panggilan')
                ->default(false);

            $table->boolean('email')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_notifikasi');
    }
};