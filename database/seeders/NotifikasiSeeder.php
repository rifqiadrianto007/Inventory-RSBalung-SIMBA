<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Stok Baru Masuk','Kabel listrik diterima di gudang utama'],
            ['Permintaan Disetujui','Pemesanan pipa PVC disetujui'],
            ['Barang Diterima','Cat proyek telah diterima'],
            ['Barang Diterima','ATK diterima bagian HR'],
            ['Login Berhasil','Superadmin berhasil login via SSO'],
            ['Pembayaran Diselesaikan','Pembayaran vendor selesai'],
            ['Barang Tertunda','Barang QC masih dalam pemeriksaan'],
            ['Instalasi Berhasil','Kabel LAN berhasil dipasang'],
            ['Pesanan Baru','Permintaan barang baru disetujui'],
            ['Stok Aman','Barang safety sudah diterima'],
        ];

        foreach ($data as $i => $item) {
            DB::table('notifikasi')->insert([
                'id_notifikasi' => $i + 1,
                'id_sso' => $i + 1,
                'judul' => $item[0],
                'pesan' => $item[1],
            ]);
        }
    }
}
