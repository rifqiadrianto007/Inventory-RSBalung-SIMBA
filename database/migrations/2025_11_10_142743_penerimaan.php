<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id('id_penerimaan');

            // data dari PPK
            $table->date('tanggal_penerimaan');
            $table->string('supplier')->nullable();
            $table->text('catatan')->nullable();

            // status utama alur
            $table->enum('status', [
                'draft_ppk',          // PPK membuat daftar barang
                'cek_teknis',         // teknis sedang memeriksa kelayakan item
                'siap_gudang',        // teknis selesai → menunggu gudang upload BAST
                'selesai'             // BAST sudah diupload, stok bertambah
            ])->default('draft_ppk');

            // status teknis
            $table->enum('status_kelayakan', [
                'belum_dicek',
                'layak',
                'tidak_layak'
            ])->default('belum_dicek');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerimaan');
    }
};
