<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->unsignedBigInteger('id_jabatan');
            $table->string('status')->default('aktif');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
