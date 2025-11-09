<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [1,'2025-11-04','selesai'],
            [2,'2025-11-04','selesai'],
            [3,'2025-11-02','selesai'],
            [4,'2025-10-30','selesai'],
            [5,'2025-11-05','selesai'],
            [6,'2025-11-03','selesai'],
            [7,'2025-11-02','selesai'],
            [8,'2025-11-02','selesai'],
            [9,'2025-11-03','selesai'],
            [10,'2025-11-04','selesai'],
        ];

        foreach ($data as $d) {
            DB::table('penerimaan')->insert([
                'id_penerimaan' => $d[0],
                'id_sso' => $d[0], // disamakan dengan user dummy
                'tanggal_penerimaan' => $d[1],
                'id_kategori' => 1, // default
                'total_harga' => 0, // akan diupdate oleh detail
                'status' => $d[2],
            ]);
        }
    }
}
