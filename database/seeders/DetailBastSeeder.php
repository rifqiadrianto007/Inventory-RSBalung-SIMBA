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
            ['Kantor Pusat'],
            ['Gedung IT'],
            ['Finance Office'],
            ['Gudang Utama'],
            ['Server Room'],
            ['Gudang Selatan'],
            ['Gudang Utama'],
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
