<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\LogAktivitas;

class AkunApiController extends Controller
{
    // ✅ Ambil semua akun
    public function index()
    {
        return response()->json(Pengguna::all());
    }

    // ✅ Detail akun
    public function show($id)
    {
        $user = Pengguna::findOrFail($id);
        return response()->json($user);
    }

    // ✅ Tambah akun baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:100',
            'email' => 'nullable|email',
            'role' => 'required|string'
        ]);

        $user = Pengguna::create($request->only('nama_pengguna','email','role'));

        LogAktivitas::create([
            'id_sso' => $user->id_sso,
            'aksi' => 'create',
            'modul' => 'akun',
            'deskripsi' => "Akun {$user->nama_pengguna} dibuat via API"
        ]);

        return response()->json(['message' => 'Akun berhasil dibuat', 'data' => $user], 201);
    }

    // ✅ Update akun
    public function update(Request $request, $id)
    {
        $user = Pengguna::findOrFail($id);
        $user->update($request->only('nama_pengguna','email','role'));

        LogAktivitas::create([
            'id_sso' => $user->id_sso,
            'aksi' => 'update',
            'modul' => 'akun',
            'deskripsi' => "Akun {$user->nama_pengguna} diupdate via API"
        ]);

        return response()->json(['message' => 'Akun diperbarui', 'data' => $user]);
    }

    // ✅ Hapus akun
    public function destroy($id)
    {
        $user = Pengguna::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Akun dihapus']);
    }

    // ✅ Monitoring semua user (aktivitas)
    public function monitoringAll()
    {
        $data = LogAktivitas::with('pengguna')->latest()->get();
        return response()->json($data);
    }

    // ✅ Monitoring 1 user
    public function monitoringUser($id)
    {
        $data = LogAktivitas::where('id_sso', $id)->latest()->get();
        return response()->json($data);
    }
}
