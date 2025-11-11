<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    protected $table = 'bast';
    protected $primaryKey = 'id_bast';

    protected $fillable = [
        'nomor_surat',
        'id_penerimaan',
        'deskripsi',
        'file_path',
    ];

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class, 'id_penerimaan', 'id_penerimaan');
    }

    public function detail()
    {
        return $this->hasMany(DetailBast::class, 'id_bast');
    }
}
