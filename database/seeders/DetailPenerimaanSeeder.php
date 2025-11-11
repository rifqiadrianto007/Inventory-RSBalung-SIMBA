<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPenerimaan;

class DetailPenerimaanSeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            // ===== PENERIMAAN ID 1 =====
            [
                'id_penerimaan' => 1,
                'id_stok' => 1,     // contoh: kabel listrik
                'volume' => 10,
                'id_satuan' => 1,   // roll
                'harga' => 150000,
                'layak' => true,
            ],
            [
                'id_penerimaan' => 1,
                'id_stok' => 2,     // pipa PVC
                'volume' => 5,
                'id_satuan' => 2,   // batang
                'harga' => 450000,
                'layak' => true,
            ],

            // ===== PENERIMAAN ID 2 =====
            [
                'id_penerimaan' => 2,
                'id_stok' => 3,     // cat tembok
                'volume' => 2,
                'id_satuan' => 3,   // kaleng
                'harga' => 2600000,
                'layak' => true,
            ],
            [
                'id_penerimaan' => 2,
                'id_stok' => 4,     // kertas A4
                'volume' => 4,
                'id_satuan' => 4,   // rim
                'harga' => 120000,
                'layak' => true,
            ],

            // ===== PENERIMAAN ID 3 =====
            [
                'id_penerimaan' => 3,
                'id_stok' => 5,     // mouse wireless
                'volume' => 3,
                'id_satuan' => 5,   // pcs
                'harga' => 5800000,
                'layak' => false,   // contoh item bermasalah
            ],
        ];

        foreach ($details as $d) {
            DetailPenerimaan::create($d);
        }
    }
}
