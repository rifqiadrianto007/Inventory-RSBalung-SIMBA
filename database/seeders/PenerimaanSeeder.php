<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penerimaan;

class PenerimaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'tanggal_penerimaan' => '2025-11-04',
                'supplier' => 'PT Maju Jaya',
                'catatan' => 'Pengadaan perlengkapan kantor',
                'status' => 'draft_ppk',
                'status_kelayakan' => 'belum_dicek',
            ],
            [
                'tanggal_penerimaan' => '2025-11-05',
                'supplier' => 'PT Mega Printindo',
                'catatan' => 'Pengadaan printer & tinta',
                'status' => 'draft_ppk',
                'status_kelayakan' => 'belum_dicek',
            ],
            [
                'tanggal_penerimaan' => '2025-11-07',
                'supplier' => 'CV Teknologi Nusantara',
                'catatan' => 'Pengadaan komputer dan periferal',
                'status' => 'draft_ppk',
                'status_kelayakan' => 'belum_dicek',
            ],
        ];

        foreach ($data as $p) {
            Penerimaan::create($p);
        }
    }
}
