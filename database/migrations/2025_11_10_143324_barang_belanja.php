<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_belanja', function (Blueprint $table) {
            $table->id('id_belanja');
            $table->unsignedBigInteger('id_penerimaan');

            $table->string('nama_barang');
            $table->integer('volume');
            $table->integer('harga');
            $table->string('satuan');

            $table->timestamps();

            // foreign key
            $table  ->foreign('id_penerimaan')
                    ->references('id_penerimaan')
                    ->on('penerimaan')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_belanja');
    }
};
