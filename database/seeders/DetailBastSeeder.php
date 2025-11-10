<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailBastSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Gudang Utama'],
            ['Area Selatan'],
            ['Gudang Timur'],
        ];

        foreach ($data as $i => $item) {
            DB::table('detail_bast')->insert([
                'id_detail_bast' => $i + 1,
                'id_bast' => $i + 1,
                'id_pegawai' => $i + 1,
                'alamat_staker' => $item[0],
            ]);
        }
    }
}
