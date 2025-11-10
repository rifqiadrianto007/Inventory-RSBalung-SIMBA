<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPenerimaan;

class DetailPenerimaanSeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            [
                'id_penerimaan' => 1,
                'id_stok' => 1,
                'volume' => 10,
                'id_satuan' => 1, // misal 'unit'
                'harga' => 150000,
                'layak' => true,
            ],
            [
                'id_penerimaan' => 1,
                'id_stok' => 2,
                'volume' => 5,
                'id_satuan' => 1,
                'harga' => 450000,
                'layak' => true,
            ],
            [
                'id_penerimaan' => 2,
                'id_stok' => 3,
                'volume' => 2,
                'id_satuan' => 1,
                'harga' => 2600000,
                'layak' => true,
            ],
            [
                'id_penerimaan' => 2,
                'id_stok' => 4,
                'volume' => 4,
                'id_satuan' => 2, // misal 'botol'
                'harga' => 120000,
                'layak' => true,
            ],
            [
                'id_penerimaan' => 3,
                'id_stok' => 5,
                'volume' => 3,
                'id_satuan' => 1,
                'harga' => 5800000,
                'layak' => false,
            ],
        ];

        foreach ($details as $d) {
            DetailPenerimaan::create($d);
        }
    }
}
