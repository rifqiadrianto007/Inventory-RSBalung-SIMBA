<h2>Monitoring Aktivitas: {{ $user->nama_pengguna }}</h2>

<a href="{{ route('akun.show', $user->id_pengguna) }}">Kembali ke Detail Akun</a> |
<a href="{{ route('akun.index') }}">Kembali ke Manajemen Akun</a>

<hr>

<h3>Informasi Akun</h3>
<p><strong>Nama:</strong> {{ $user->nama_pengguna }}</p>
<p><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
<p><strong>Role:</strong> {{ $user->role }}</p>
<p><strong>ID SSO:</strong> {{ $user->id_sso }}</p>

<hr>

<h3>Riwayat Aktivitas</h3>

<table border="1" cellpadding="6">
    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Modul</th>
        <th>Deskripsi</th>
        <th>Waktu</th>
    </tr>

    @forelse ($logs as $i => $log)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $log->aksi }}</td>
        <td>{{ $log->modul }}</td>
        <td>{{ $log->deskripsi }}</td>
        <td>{{ $log->created_at }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Belum ada aktivitas untuk user ini.</td>
    </tr>
    @endforelse
</table>
