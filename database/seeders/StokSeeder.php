<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [1,'Kabel Listrik 2m',4,1,120],
            [2,'Pipa PVC 3 inch',3,2,300],
            [3,'Cat Tembok 5L',1,3,45],
            [4,'Kertas A4 80gsm',6,4,60],
            [5,'Mouse Wireless',7,5,80],
            [6,'Printer Canon L2',5,6,10],
            [7,'Helm Proyek',3,1,25],
            [8,'Kabel LAN 10m',4,1,75],
            [9,'Obeng Set',1,5,40],
            [10,'Sarung Tangan',1,3,100],
        ];

        foreach ($data as $i) {
            DB::table('stok')->insert([
                'id_stok' => $i[0],
                'nama_barang' => $i[1],
                'id_kategori' => $i[2],
                'id_satuan' => $i[3],
                'total_stok' => $i[4]
            ]);
        }
    }
}
