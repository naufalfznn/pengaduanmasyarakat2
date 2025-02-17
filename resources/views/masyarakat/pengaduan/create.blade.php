@extends('layouts.app')

@section('content')
<h1>Buat Laporan</h1>

<form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- Input kategori -->
    <label for="kategori">Kategori:</label>
    <select name="kategori" id="kategori" required>
        <option value="" disabled selected>Pilih Kategori</option>
        <option value="Kebersihan">Kebersihan</option>
        <option value="Keamanan">Keamanan</option>
        <option value="Pelanggaran">Pelanggaran</option>
        <option value="Fasilitas Umum">Fasilitas Umum</option>
    </select>
    <br><br>

    <!-- Input lokasi -->
    <label for="lokasi">Lokasi:</label>
    <input type="text" name="lokasi" id="lokasi" placeholder="Masukkan lokasi kejadian" required>
    <br><br>

    <!-- Input isi laporan -->
    <label for="isi_laporan">Isi Laporan:</label>
    <textarea name="isi_laporan" id="isi_laporan" rows="5" required></textarea>
    <br><br>

    <!-- Upload foto -->
    <label for="foto">Upload Foto:</label>
    <input type="file" name="foto" id="foto">
    <br><br>

    <!-- Tombol Kirim -->
    <button type="submit">Kirim Laporan</button>
</form>
@endsection
