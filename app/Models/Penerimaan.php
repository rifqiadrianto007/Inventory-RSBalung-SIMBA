<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $table = 'penerimaan';
    protected $primaryKey = 'id_penerimaan';

    protected $fillable = [
        'tanggal_penerimaan',
        'supplier',
        'status',             // draft_ppk, menunggu_kelayakan, siap_gudang, selesai
        'status_kelayakan',   // belum_dicek, layak, tidak_layak
        'catatan'
    ];

    // Relasi ke Detail Penerimaan (list item)
    public function detail()
    {
        return $this->hasMany(DetailPenerimaan::class, 'id_penerimaan');
    }

    // Relasi ke BAST (1 penerimaan 1 dokumen BAST)
    public function bast()
    {
        return $this->hasOne(Bast::class, 'id_penerimaan');
    }
}
