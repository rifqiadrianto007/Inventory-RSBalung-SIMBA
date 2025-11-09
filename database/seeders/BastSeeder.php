<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BastSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['BAST-001','Pengiriman kabel listrik','Gudang Utama','Instalasi A','pending'],
            ['BAST-002','Serah terima pipa PVC','Area Selatan','Instalasi B','selesai'],
            ['BAST-003','Pengiriman cat proyek','Gudang Timur','Instalasi C','pending'],
            ['BAST-004','Serah terima ATK','Kantor Pusat','Instalasi D','selesai'],
            ['BAST-005','Distribusi mouse','Gedung IT','Instalasi A','selesai'],
            ['BAST-006','Penyerahan printer','Finance Office','Instalasi F','selesai'],
            ['BAST-007','Distribusi helm kerja','Gudang Utama','Instalasi E','pending'],
            ['BAST-008','Serah terima kabel LAN','Server Room','Instalasi IT','selesai'],
            ['BAST-009','Penyerahan alat','Gudang Selatan','Instalasi G','selesai'],
            ['BAST-010','Penyerahan sarung tangan','Gudang Utama','Instalasi H','selesai'],
        ];

        foreach ($data as $i => $item) {
            DB::table('bast')->insert([
                'id_bast' => $i + 1,
                'nomor_surat' => $item[0],
                'id_penerimaan' => $i + 1,
                'deskripsi' => $item[1],
                'file_path' => null,
            ]);
        }
    }
}
