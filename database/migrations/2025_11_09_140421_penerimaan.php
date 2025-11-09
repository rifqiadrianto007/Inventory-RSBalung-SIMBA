<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id('id_penerimaan');
            $table->integer('id_sso');
            $table->date('tanggal_penerimaan');
            $table->unsignedBigInteger('id_kategori');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerimaan');
    }
};
