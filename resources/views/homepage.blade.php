<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        body {
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background: #222;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        nav {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .container {
            flex: 1;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .content {
            display: none;
        }
        .active {
            display: block;
        }
        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 15px;
            width: 100%;
            position: relative;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Selamat Datang di Laporin</h1>
</header>

<nav>
    <a href="#" onclick="showContent('home')">Home</a>
    <a href="#" onclick="showContent('tentang')">Tentang</a>
    <a href="#" onclick="showContent('kontak')">Kontak</a>
    <a href="#" onclick="showContent('bantuan')">Bantuan</a>
    <a href="{{ route('login') }}">Login</a>
</nav>

<div class="container">
    <div id="home" class="content active">
        <h2>Selamat Datang</h2>
        <p>Sistem Pengaduan Masyarakat membantu warga untuk melaporkan permasalahan mereka secara online.</p>
        <img src="{{ asset('images/banner.jpg') }}" width="100%" alt="Banner Pengaduan">
    </div>

    <div id="tentang" class="content">
        <h2>Tentang</h2>
        <p>Aplikasi ini dibuat untuk memudahkan masyarakat dalam melaporkan kejadian atau masalah yang mereka hadapi.</p>
    </div>

    <div id="kontak" class="content">
        <h2>Kontak</h2>
        <p>Email: support@pengaduanmasyarakat.com</p>
        <p>Telepon: 0812-3456-7890</p>
        <p>Alamat: Jl. Raya No. 123, Jakarta</p>
    </div>

    <div id="bantuan" class="content">
        <h2>Bantuan</h2>
        <p>Jika Anda mengalami kesulitan dalam penggunaan aplikasi ini, silakan hubungi tim support kami melalui email atau telepon.</p>
    </div>
</div>

<footer>
    <p>&copy; 2025 Pengaduan Masyarakat</p>
</footer>

<script>
    function showContent(id) {
        var contents = document.querySelectorAll('.content');
        contents.forEach(content => content.classList.remove('active'));

        document.getElementById(id).classList.add('active');
    }
</script>

</body>
</html>
