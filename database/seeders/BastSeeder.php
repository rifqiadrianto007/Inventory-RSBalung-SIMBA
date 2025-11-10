<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BastSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['BAST-001','Pengiriman kabel listrik','Gudang Utama','Instalasi A','pending'],
            ['BAST-002','Pengiriman pipa PVC','Gudang Selatan','Instalasi B','selesai'],
            ['BAST-003','Pengiriman cat tembok','Gudang Timur','Instalasi C','pending'],
        ];

        foreach ($data as $i => $item) {
            DB::table('bast')->insert([
                'id_bast' => $i + 1,
                'nomor_surat' => $item[0],
                'id_penerimaan' => $i + 1,
                'deskripsi' => $item[1],
                'file_path' => null,
            ]);
        }
    }
}
