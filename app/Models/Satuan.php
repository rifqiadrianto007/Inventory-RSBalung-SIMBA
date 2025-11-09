<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satuan extends Model
{
    use SoftDeletes;

    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';

    protected $fillable = ['nama_satuan'];

    public function detailPenerimaan()
    {
        return $this->hasMany(DetailPenerimaan::class, 'id_satuan', 'id_satuan');
    }

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_satuan', 'id_satuan');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_satuan', 'id_satuan');
    }
}
