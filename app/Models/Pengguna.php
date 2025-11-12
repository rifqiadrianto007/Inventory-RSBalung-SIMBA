<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = true;

    protected $fillable = [
        'id_sso','nama_pengguna','email','photo','role'
    ];

    protected $casts = [
        'id_sso' => 'integer',
    ];

    // Relasi ke transaksi berbasis SSO
    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_sso', 'id_sso');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_sso', 'id_sso');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_sso', 'id_sso');
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'id_sso', 'id_sso');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function getDisplayNameAttribute()
    {
        return ucfirst($this->nama_pengguna);
    }
}
