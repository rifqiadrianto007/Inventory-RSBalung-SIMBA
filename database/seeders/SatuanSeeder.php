<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $satuan = [
            ['id_satuan' => 1, 'nama_satuan' => 'roll'],
            ['id_satuan' => 2, 'nama_satuan' => 'batang'],
            ['id_satuan' => 3, 'nama_satuan' => 'kaleng'],
            ['id_satuan' => 4, 'nama_satuan' => 'rim'],
            ['id_satuan' => 5, 'nama_satuan' => 'pcs'],
            ['id_satuan' => 6, 'nama_satuan' => 'unit'],
            ['id_satuan' => 7, 'nama_satuan' => 'set'],
            ['id_satuan' => 8, 'nama_satuan' => 'pasang'],
        ];

        DB::table('satuan')->insert($satuan);
    }
}
