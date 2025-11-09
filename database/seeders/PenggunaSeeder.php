<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_pengguna' => 1, 'nama_pengguna' => 'admin1', 'id_sso' => 1, 'email' => 'user1@mail.com', 'role' => 'admin'],
            ['id_pengguna' => 2, 'nama_pengguna' => 'user_op1', 'id_sso' => 2, 'email' => 'user2@mail.com', 'role' => 'operator'],
            ['id_pengguna' => 3, 'nama_pengguna' => 'user_gudang', 'id_sso' => 3, 'email' => 'user3@mail.com', 'role' => 'staff'],
            ['id_pengguna' => 4, 'nama_pengguna' => 'user_hrd', 'id_sso' => 4, 'email' => 'user4@mail.com', 'role' => 'hrd'],
            ['id_pengguna' => 5, 'nama_pengguna' => 'superadmin', 'id_sso' => 5, 'email' => 'user5@mail.com', 'role' => 'super_admin'],
            ['id_pengguna' => 6, 'nama_pengguna' => 'user_fin', 'id_sso' => 6, 'email' => 'user6@mail.com', 'role' => 'finance'],
            ['id_pengguna' => 7, 'nama_pengguna' => 'user_qc', 'id_sso' => 7, 'email' => 'user7@mail.com', 'role' => 'qc'],
            ['id_pengguna' => 8, 'nama_pengguna' => 'user_it', 'id_sso' => 8, 'email' => 'user8@mail.com', 'role' => 'it_support'],
            ['id_pengguna' => 9, 'nama_pengguna' => 'user_proc', 'id_sso' => 9, 'email' => 'user9@mail.com', 'role' => 'procurement'],
            ['id_pengguna' => 10, 'nama_pengguna' => 'user_admin2', 'id_sso' => 10, 'email' => 'user10@mail.com', 'role' => 'admin'],
        ];

        DB::table('pengguna')->insert($data);
    }
}
