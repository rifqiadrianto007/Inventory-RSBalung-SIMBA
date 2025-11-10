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
                'nomor_po' => 'PO-001',
                'nama_barang' => 'Kursi Lipat',
                'jumlah' => 10,
                'satuan' => 'unit',
                'tanggal_penerimaan' => '2025-11-04',
                'supplier' => 'PT Maju Jaya',
                'status_kelayakan' => 'belum_dicek',
            ],
            [
                'nomor_po' => 'PO-002',
                'nama_barang' => 'Peralatan Printer',
                'jumlah' => 6,
                'satuan' => 'paket',
                'tanggal_penerimaan' => '2025-11-05',
                'supplier' => 'PT Mega Printindo',
                'status_kelayakan' => 'belum_dicek',
            ],
            [
                'nomor_po' => 'PO-003',
                'nama_barang' => 'Komputer & Periferal',
                'jumlah' => 3,
                'satuan' => 'unit',
                'tanggal_penerimaan' => '2025-11-07',
                'supplier' => 'CV Teknologi Nusantara',
                'status_kelayakan' => 'belum_dicek',
            ],
        ];

        foreach ($data as $p) {
            Penerimaan::create($p);
        }
    }
}
