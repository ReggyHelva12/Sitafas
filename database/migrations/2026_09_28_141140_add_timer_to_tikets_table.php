<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tikets', function (Blueprint $table) {

            // Durasi layanan dalam menit
            $table->unsignedInteger('durasi_timer')
                ->nullable()
                ->after('waktu_mulai');

            // Waktu timer berakhir
            $table->dateTime('timer_berakhir')
                ->nullable()
                ->after('durasi_timer');

            // Menyimpan jumlah reset timer
            $table->unsignedInteger('jumlah_reset_timer')
                ->default(0)
                ->after('timer_berakhir');

            // Status timer
            $table->enum('status_timer', [
                'belum_mulai',
                'berjalan',
                'habis',
                'reset',
                'selesai'
            ])
                ->default('belum_mulai')
                ->after('jumlah_reset_timer');
        });
    }

    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {

            $table->dropColumn([
                'durasi_timer',
                'timer_berakhir',
                'jumlah_reset_timer',
                'status_timer',
            ]);

        });
    }
};