<h2>Detail Akun Pengguna</h2>

<a href="{{ route('akun.index') }}">Kembali ke Manajemen Akun</a>
<hr>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID Pengguna</th>
        <td>{{ $user->id_pengguna }}</td>
    </tr>
    <tr>
        <th>ID SSO</th>
        <td>{{ $user->id_sso }}</td>
    </tr>
    <tr>
        <th>Nama Pengguna</th>
        <td>{{ $user->nama_pengguna }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email ?? '-' }}</td>
    </tr>
    <tr>
        <th>Role</th>
        <td>{{ $user->role }}</td>
    </tr>

    @if($user->photo)
    <tr>
        <th>Foto Profil</th>
        <td>
            <img src="{{ asset('storage/profile/'.$user->photo) }}" width="120">
        </td>
    </tr>
    @endif

    @if($user->ttd)
    <tr>
        <th>Foto TTD</th>
        <td>
            <img src="{{ asset('storage/ttd/'.$user->ttd) }}" width="150">
        </td>
    </tr>
    @endif

    <tr>
        <th>Dibuat Pada</th>
        <td>{{ $user->created_at }}</td>
    </tr>

    <tr>
        <th>Terakhir Diperbarui</th>
        <td>{{ $user->updated_at }}</td>
    </tr>
</table>

<br>

<a href="{{ route('monitoring.peruser', $user->id_pengguna) }}">Monitoring Aktivitas User Ini</a> |
<a href="{{ route('akun.edit', $user->id_pengguna) }}">Edit Akun</a> |
<form action="{{ route('akun.destroy', $user->id_pengguna) }}" method="POST" style="display:inline;">
    @csrf @method('DELETE')
    <button type="submit" onclick="return confirm('Hapus akun ini?')">Hapus Akun</button>
</form>
