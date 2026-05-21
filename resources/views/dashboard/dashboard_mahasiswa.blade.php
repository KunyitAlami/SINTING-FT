<h1>Dashboard Mahasiswa</h1>
<p>Selamat datang, {{ session('nama') }}</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>