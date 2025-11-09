<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stok extends Model
{
    use SoftDeletes;

    protected $table = 'stok';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'nama_barang','id_kategori','stok_tahun_2024','total_stok',
        'minimum_stok','harga','id_satuan'
    ];

    protected $casts = [
        'stok_tahun_2024' => 'integer',
        'total_stok'      => 'integer',
        'minimum_stok'    => 'integer',
        'harga'           => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

    public function detailPenerimaan()
    {
        return $this->hasMany(DetailPenerimaan::class, 'id_stok', 'id_stok');
    }

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_stok', 'id_stok');
    }
}
