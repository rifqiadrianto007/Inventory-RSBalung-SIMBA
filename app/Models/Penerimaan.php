<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penerimaan extends Model
{
    use SoftDeletes;

    protected $table = 'penerimaan';
    protected $primaryKey = 'id_penerimaan';

    protected $fillable = [
        'id_sso','tanggal_penerimaan','id_kategori','total_harga','status'
    ];

    protected $casts = [
        'tanggal_penerimaan' => 'date',
        'total_harga' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function details()
    {
        return $this->hasMany(DetailPenerimaan::class, 'id_penerimaan', 'id_penerimaan');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_sso', 'id_sso');
    }

    public function bast()
    {
        return $this->hasOne(Bast::class, 'id_penerimaan', 'id_penerimaan');
    }
}
