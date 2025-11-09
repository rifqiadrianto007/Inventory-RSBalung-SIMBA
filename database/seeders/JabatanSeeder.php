<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatan = [
            ['id_jabatan' => 1, 'nama_jabatan' => 'Kepala Gudang'],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Operator Lapangan'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Staff Gudang'],
            ['id_jabatan' => 4, 'nama_jabatan' => 'HRD'],
            ['id_jabatan' => 5, 'nama_jabatan' => 'Kepala IT'],
            ['id_jabatan' => 6, 'nama_jabatan' => 'Staff Keuangan'],
            ['id_jabatan' => 7, 'nama_jabatan' => 'Quality Control'],
            ['id_jabatan' => 8, 'nama_jabatan' => 'IT Support'],
            ['id_jabatan' => 9, 'nama_jabatan' => 'Pengadaan'],
            ['id_jabatan' => 10, 'nama_jabatan' => 'Admin Operasional'],
        ];

        DB::table('jabatan')->insert($jabatan);
    }
}
