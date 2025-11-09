<h2>Profil Pengguna</h2>

<p>Nama: {{ $user->nama_pengguna }}</p>
<p>Email: {{ $user->email }}</p>
<p>Role: {{ $user->role }}</p>

@if ($user->photo)
    <img src="{{ asset('storage/profile/'.$user->photo) }}" width="100">
@endif

<br><br>

<a href="{{ route('profile.edit') }}">Edit Profil</a> |
<a href="{{ route('faq') }}">FAQ</a> |
<a href="{{ route('logout') }}">Logout</a>
