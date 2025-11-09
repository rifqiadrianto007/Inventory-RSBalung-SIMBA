<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\LogAktivitas;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Pengguna::where('id_pengguna', session('id_pengguna'))->first();
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Pengguna::find(session('id_pengguna'));
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'email' => 'nullable|email',
            'photo' => 'nullable|image'
        ]);

        $user = Pengguna::find(session('id_pengguna'));

        $user->nama_pengguna = $request->nama_pengguna;
        $user->email = $request->email;

        // Jika mengupload foto
        if ($request->hasFile('photo')) {
            $filename = time().'_'.$request->photo->getClientOriginalName();
            $request->photo->storeAs('profile', $filename, 'public');
            $user->photo = $filename;
        }

        $user->save();

        // Log aktivitas
        LogAktivitas::create([
            'id_sso' => $user->id_sso,
            'aksi' => 'update',
            'modul' => 'pengguna',
            'deskripsi' => 'User '.$user->nama_pengguna.' mengubah profil'
        ]);

        return redirect()->route('profile.index')
                         ->with('success', 'Profil berhasil diperbarui');
    }

    public function faq()
    {
        return view('FAQ');
    }
}
