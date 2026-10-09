<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tikets', function (Blueprint $table) {

            $table->enum('status', [
                'menunggu',
                'dipanggil',
                'dilayani',
                'selesai'
            ])
            ->default('menunggu')
            ->after('nomor_tiket');

        });
    }

    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {

            $table->dropColumn('status');

        });
    }
};