<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    public $timestamps = true;
    public const UPDATED_AT = null; // hanya created_at

    protected $fillable = ['id_sso','judul','pesan'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_sso', 'id_sso');
    }
}
