<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';
    public $timestamps = true;
    public const UPDATED_AT = null; // hanya created_at

    protected $fillable = ['id_sso','aksi','modul','deskripsi'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_sso', 'id_sso');
    }
}
