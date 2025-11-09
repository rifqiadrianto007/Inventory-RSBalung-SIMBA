<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\LogAktivitas;

class AkunController extends Controller
{
    public function index()
    {
        // Hanya super admin yang boleh masuk
        if (session('role') !== 'super_admin') {
            abort(403, 'Akses ditolak');
        }

        $akun = Pengguna::all();
        return view('manajemenAkun', compact('akun'));
    }

    public function create()
    {
        return view('tambahAkun');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'email' => 'nullable|email',
            'role' => 'required',
        ]);

        $user = Pengguna::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'role' => $request->role,
            'id_sso' => rand(100, 999), // dummy ID SSO
        ]);

        LogAktivitas::create([
            'id_sso' => session('id_sso'),
            'aksi' => 'create',
            'modul' => 'akun',
            'deskripsi' => 'Super Admin menambahkan akun '.$user->nama_pengguna
        ]);

        return redirect()->route('akun.index')
                         ->with('success','Akun baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = Pengguna::findOrFail($id);
        return view('tambahAkun', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'email' => 'nullable|email',
            'role' => 'required',
        ]);

        $user = Pengguna::findOrFail($id);

        $user->nama_pengguna = $request->nama_pengguna;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        LogAktivitas::create([
            'id_sso' => session('id_sso'),
            'aksi' => 'update',
            'modul' => 'akun',
            'deskripsi' => 'Super Admin mengedit akun '.$user->nama_pengguna
        ]);

        return redirect()->route('akun.index')->with('success','Akun berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = Pengguna::findOrFail($id);

        $user->delete();

        LogAktivitas::create([
            'id_sso' => session('id_sso'),
            'aksi' => 'delete',
            'modul' => 'akun',
            'deskripsi' => 'Super Admin menghapus akun '.$user->nama_pengguna
        ]);

        return redirect()->route('akun.index')->with('success','Akun berhasil dihapus');
    }
}
