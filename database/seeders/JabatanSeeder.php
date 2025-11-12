<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatan = [
            ['id_jabatan' => 1, 'nama_jabatan' => 'Admin Gudang Umum'],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Instalasi'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Super Admin'],
            ['id_jabatan' => 4, 'nama_jabatan' => 'Teknis'],
            ['id_jabatan' => 5, 'nama_jabatan' => 'PPK'],
        ];

        DB::table('jabatan')->insert($jabatan);
    }
}
