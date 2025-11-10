<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_bast', function (Blueprint $table) {
            $table->id('id_detail_bast');
            $table->unsignedBigInteger('id_bast');
            $table->unsignedBigInteger('id_pegawai');
            $table->string('alamat_staker');
            $table->timestamps();

            $table->foreign('id_bast')->references('id_bast')->on('bast');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_bast');
    }
};
