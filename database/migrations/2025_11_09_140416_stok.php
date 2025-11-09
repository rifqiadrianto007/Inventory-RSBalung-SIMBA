<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id('id_stok');
            $table->string('nama_barang');
            $table->unsignedBigInteger('id_kategori');
            $table->integer('stok_tahun_2024')->default(0);
            $table->integer('total_stok')->default(0);
            $table->integer('minimum_stok')->default(0);
            $table->decimal('harga', 12, 2)->default(0);
            $table->unsignedBigInteger('id_satuan');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->foreign('id_satuan')->references('id_satuan')->on('satuan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};
