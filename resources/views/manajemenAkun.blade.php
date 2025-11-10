<h2>Manajemen Akun (Super Admin)</h2>

<a href="{{ route('akun.create') }}">Tambah Akun</a> |
<a href="{{ route('monitoring.index') }}">Monitoring Aktivitas</a> |
<a href="{{ route('logout') }}">Logout</a>

<hr>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Role</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    @forelse ($akun as $a)
    <tr>
        <td>{{ $a->id_pengguna }}</td>
        <td>{{ $a->nama_pengguna }}</td>
        <td>{{ $a->role }}</td>
        <td>{{ $a->email }}</td>
        <td>
            <a href="{{ route('akun.show', $a->id_pengguna) }}">Detail</a> |
            <a href="{{ route('akun.edit', $a->id_pengguna) }}">Edit</a> |
            <form action="{{ route('akun.destroy', $a->id_pengguna) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus akun ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Belum ada data akun.</td>
    </tr>
    @endforelse
</table>

