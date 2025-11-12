<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [1,'Budi Santoso','1987654321',1,'81234567890','active'],
            [2,'Ahmad Fauzi','1987654322',2,'81298765432','active'],
            [3,'Siti Aisyah','1987654323',3,'81345678901','active'],
            [4,'Dian Rahma','1987654324',4,'81367890123','inactive'],
            [5,'Rudi Hartono','1987654325',5,'81389012345','active'],
        ];

        foreach ($data as $p) {
            DB::table('pegawai')->insert([
                'id_pegawai' => $p[0],
                'nama' => $p[1],
                'nip' => $p[2],
                'id_jabatan' => $p[3],
                'status' => $p[5],
            ]);
        }
    }
}
