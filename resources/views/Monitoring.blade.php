<h2>Monitoring Aktivitas User</h2>

<a href="{{ route('akun.index') }}">Kembali ke Manajemen Akun</a>
<hr>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Role</th>
        <th>Aksi</th>
        <th>Modul</th>
        <th>Deskripsi</th>
        <th>Waktu</th>
    </tr>

    @foreach ($logs as $i => $log)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $log->pengguna->nama_pengguna ?? 'Unknown User' }}</td>
        <td>{{ $log->pengguna->role ?? '-' }}</td>
        <td>{{ $log->aksi }}</td>
        <td>{{ $log->modul }}</td>
        <td>{{ $log->deskripsi }}</td>
        <td>{{ $log->created_at }}</td>
    </tr>
    @endforeach
</table>
