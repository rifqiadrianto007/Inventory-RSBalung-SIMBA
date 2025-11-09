<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            JabatanSeeder::class,
            KategoriSeeder::class,
            SatuanSeeder::class,
            PenggunaSeeder::class,
            PegawaiSeeder::class,
            StokSeeder::class,
            PenerimaanSeeder::class,
            DetailPenerimaanSeeder::class,
            BastSeeder::class,
            DetailBastSeeder::class,
            NotifikasiSeeder::class,
            LogAktivitasSeeder::class,
        ]);
    }
}
