<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori'];

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_kategori', 'id_kategori');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_kategori', 'id_kategori');
    }
}
