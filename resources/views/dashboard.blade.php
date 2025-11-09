<h2>Dashboard Admin</h2>

<p>Selamat datang, {{ session('nama') }} (Role: {{ session('role') }})</p>

<a href="{{ route('profile.index') }}">Profile</a> |
<a href="{{ route('logout') }}">Logout</a>

<hr>

<p>Halaman Dashboard Dummy</p>
