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
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id('id_penerimaan');
            $table->string('nomor_po')->nullable();
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->date('tanggal_penerimaan');
            $table->string('supplier')->nullable();

             // untuk teknis
            $table->enum('status_kelayakan', ['layak', 'tidak_layak', 'belum_dicek'])
                ->default('belum_dicek');
            $table->text('catatan')->nullable();

            // untuk admin gudang
            $table->string('file_bast')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan');
    }
};
