<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenerimaan extends Model
{
    protected $table = 'detail_penerimaan';
    protected $primaryKey = 'id_detail_penerimaan';

    protected $fillable = [
        'id_penerimaan',
        'id_stok',
        'volume',
        'id_satuan',
        'harga',
        'layak'
    ];

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class, 'id_penerimaan');
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
