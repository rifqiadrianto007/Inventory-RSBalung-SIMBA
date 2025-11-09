<h2>Edit Profil</h2>

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf

    <label>Nama Pengguna</label><br>
    <input type="text" name="nama_pengguna" value="{{ $user->nama_pengguna }}"><br><br>

    <label>Email</label><br>
    <input type="text" name="email" value="{{ $user->email }}"><br><br>

    <label>Foto Profil</label><br>
    <input type="file" name="photo"><br><br>

    <button type="submit">Simpan</button>
</form>
