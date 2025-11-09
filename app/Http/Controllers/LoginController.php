<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\LogAktivitas;

class LoginController extends Controller
{
    public function index()
    {
        return view('V_HalLogin');
    }

    public function autentikasi(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Karena Anda memakai data dummy SSO, kita cek manual username
        $user = Pengguna::where('nama_pengguna', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan']);
        }

        // password dummy → semua "password"
        if ($request->password !== 'password') {
            return back()->withErrors(['password' => 'Password salah']);
        }

        // Simpan Session
        session([
            'id_pengguna' => $user->id_pengguna,
            'id_sso' => $user->id_sso,
            'role' => $user->role,
            'nama' => $user->nama_pengguna
        ]);

        // Catat log login
        LogAktivitas::create([
            'id_sso' => $user->id_sso,
            'aksi' => 'login',
            'modul' => 'auth',
            'deskripsi' => $user->nama_pengguna.' berhasil login'
        ]);

        // Routing berdasarkan role (sesuai dokumen)
        switch ($user->role) {
            case 'super_admin':
                return redirect()->route('akun.index');

            case 'admin':
            case 'admin gudang umum':
                return redirect()->route('dashboard');

            case 'ppk':
            case 'teknis':
            case 'penanggung jawab':
                return redirect()->route('penerimaan.index');

            case 'instalasi':
                return redirect()->route('pemesanan.index');

            default:
                return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        $id = session('id_sso');

        LogAktivitas::create([
            'id_sso' => $id,
            'aksi' => 'logout',
            'modul' => 'auth',
            'deskripsi' => 'User melakukan logout'
        ]);

        session()->flush();

        return redirect()->route('login');
    }
}
