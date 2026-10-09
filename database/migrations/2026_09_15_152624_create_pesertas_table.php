<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id('id_peserta');

            $table->foreignId('id_pt')
                ->constrained('perguruan_tinggis', 'id_pt')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('nama_pic', 100);
            $table->string('no_hp', 20);
            $table->string('email', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};