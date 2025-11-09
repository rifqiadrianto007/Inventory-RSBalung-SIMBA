<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = ['nama','nip','id_jabatan','status'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function detailBast()
    {
        return $this->hasMany(DetailBast::class, 'id_pegawai', 'id_pegawai');
    }
}
