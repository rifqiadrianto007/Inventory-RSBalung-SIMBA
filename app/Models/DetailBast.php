<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBast extends Model
{
    protected $table = 'detail_bast';
    protected $primaryKey = 'id_detail_bast';

    protected $fillable = ['id_bast','id_pegawai','alamat_staker'];

    public function bast()
    {
        return $this->belongsTo(Bast::class, 'id_bast', 'id_bast');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
