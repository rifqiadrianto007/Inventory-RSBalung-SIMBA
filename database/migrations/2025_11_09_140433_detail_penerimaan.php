<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_penerimaan', function (Blueprint $table) {
            $table->id('id_detail_penerimaan');
            $table->unsignedBigInteger('id_penerimaan');
            $table->unsignedBigInteger('id_stok');
            $table->decimal('volume', 12, 2);
            $table->unsignedBigInteger('id_satuan');
            $table->decimal('harga', 12, 2)->default(0);
            $table->boolean('layak')->default(true);
            $table->timestamps();

            $table->foreign('id_penerimaan')->references('id_penerimaan')->on('penerimaan');
            $table->foreign('id_stok')->references('id_stok')->on('stok');
            $table->foreign('id_satuan')->references('id_satuan')->on('satuan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penerimaan');
    }
};
