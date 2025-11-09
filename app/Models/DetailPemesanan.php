<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_detail_pemesanan';

    protected $fillable = ['id_pemesanan','id_stok','id_satuan','volume'];

    protected $casts = [
        'volume' => 'decimal:2',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'id_stok', 'id_stok');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }
}
