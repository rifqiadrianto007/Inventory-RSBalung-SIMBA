<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $table = 'penerimaan';
    protected $primaryKey = 'id_penerimaan';

    protected $fillable = [
        'nomor_po',
        'nama_barang',
        'jumlah',
        'satuan',
        'tanggal_penerimaan',
        'supplier',
        'status_kelayakan',
        'catatan',
        'file_bast'
    ];

    // Relasi ke Detail Penerimaan
    public function detail()
    {
        return $this->hasMany(DetailPenerimaan::class, 'id_penerimaan', 'id_penerimaan');
    }

    // Relasi ke BAST
    public function bast()
    {
        return $this->hasOne(Bast::class, 'id_penerimaan', 'id_penerimaan');
    }
}
