<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tikets', function (Blueprint $table) {
            $table->string('aksi_terakhir')->nullable()->after('status_timer');
            $table->timestamp('waktu_aksi')->nullable()->after('aksi_terakhir');
        });
    }

    public function down(): void
    {
        Schema::table('tikets', function (Blueprint $table) {
            $table->dropColumn([
                'aksi_terakhir',
                'waktu_aksi'
            ]);
        });
    }
};