<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>NIK:</label>
        <input type="text" name="nik" required>
        <br>
        <label>Nama:</label>
        <input type="text" name="nama" required>
        <br>
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <label>Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" required>
        <br>
        <label>Telepon:</label>
        <input type="text" name="telp" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email">
        <br>
        <label>Alamat:</label>
        <textarea name="alamat"></textarea>
        <br>
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>.</p>
</body>
</html>
