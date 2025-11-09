<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['login','Inventory','User admin1 login melalui SSO'],
            ['create','Penerimaan','Operator menambah data penerimaan baru'],
            ['update','Stok','Stok cat tembok diperbarui'],
            ['delete','Pemesanan','HRD menghapus pemesanan lama'],
            ['login','User','Superadmin login sistem'],
            ['create','Pembayaran','Staff finance input data pembayaran'],
            ['update','QC','QC melakukan update hasil inspeksi'],
            ['login','IT','IT support login sistem inventory'],
            ['create','Procurement','Data pengadaan baru berhasil dibuat'],
            ['login','System','Admin operasional login ke sistem'],
        ];

        foreach ($data as $i => $item) {
            DB::table('log_aktivitas')->insert([
                'id_log' => $i + 1,
                'id_sso' => $i + 1,
                'aksi' => $item[0],
                'modul' => $item[1],
                'deskripsi' => $item[2],
            ]);
        }
    }
}
