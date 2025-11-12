<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_pengguna' => 1, 'nama_pengguna' => 'admingudangumum', 'id_sso' => 1, 'email' => 'user1@mail.com', 'role' => 'admin gudang umum'],
            ['id_pengguna' => 2, 'nama_pengguna' => 'instalasi', 'id_sso' => 2, 'email' => 'user2@mail.com', 'role' => 'instalasi'],
            ['id_pengguna' => 3, 'nama_pengguna' => 'superadmin', 'id_sso' => 3, 'email' => 'user5@mail.com', 'role' => 'super_admin'],
            ['id_pengguna' => 4, 'nama_pengguna' => 'teknis', 'id_sso' => 4, 'email' => 'user6@mail.com', 'role' => 'teknis'],
            ['id_pengguna' => 5, 'nama_pengguna' => 'ppk', 'id_sso' => 5, 'email' => 'user7@mail.com', 'role' => 'ppk'],
        ];

        DB::table('pengguna')->insert($data);
    }
}
