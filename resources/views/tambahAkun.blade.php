<h2>{{ isset($user) ? 'Edit Akun' : 'Tambah Akun Baru' }}</h2>

<form method="POST" action="{{ isset($user) ? route('akun.update', $user->id_pengguna) : route('akun.store') }}">
    @csrf
    @if(isset($user)) @method('PUT') @endif

    <label>Nama Pengguna</label><br>
    <input type="text" name="nama_pengguna" value="{{ $user->nama_pengguna ?? '' }}"><br><br>

    <label>Email</label><br>
    <input type="text" name="email" value="{{ $user->email ?? '' }}"><br><br>

    <label>Role</label><br>
    <input type="text" name="role" value="{{ $user->role ?? '' }}"><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('akun.index') }}">Kembali</a>
