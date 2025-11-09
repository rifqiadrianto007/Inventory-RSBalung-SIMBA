<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['id_kategori' => 1, 'nama_kategori' => 'Elektrikal'],
            ['id_kategori' => 2, 'nama_kategori' => 'Plumbing'],
            ['id_kategori' => 3, 'nama_kategori' => 'Material Bangunan'],
            ['id_kategori' => 4, 'nama_kategori' => 'ATK'],
            ['id_kategori' => 5, 'nama_kategori' => 'Elektronik'],
            ['id_kategori' => 6, 'nama_kategori' => 'Safety'],
            ['id_kategori' => 7, 'nama_kategori' => 'Peralatan'],
            ['id_kategori' => 8, 'nama_kategori' => 'Safety'],
        ];

        DB::table('kategori')->insert($kategori);
    }
}
