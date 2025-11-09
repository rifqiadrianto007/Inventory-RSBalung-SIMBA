<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPenerimaanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [1, 50, 15000, true],
            [2, 100, 25000, true],
            [3, 10, 80000, true],
            [4, 30, 50000, true],
            [5, 40, 120000, true],
            [6, 2, 2000000, true],
            [7, 15, 50000, true],
            [8, 20, 50000, true],
            [9, 10, 150000, true],
            [10, 50, 20000, true],
        ];

        foreach ($items as $i) {
            DB::table('detail_penerimaan')->insert([
                'id_penerimaan' => $i[0],
                'id_stok' => $i[0],
                'volume' => $i[1],
                'id_satuan' => 1,
                'harga' => $i[2],
                'layak' => $i[3],
            ]);

            // Update total harga
            DB::table('penerimaan')
                ->where('id_penerimaan', $i[0])
                ->update([
                    'total_harga' => DB::raw($i[1] * $i[2])
                ]);
        }
    }
}
