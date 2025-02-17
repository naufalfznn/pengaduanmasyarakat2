@extends('layouts.app')

@section('content')
<h1>Berikan Tanggapan</h1>

<p><strong>Laporan:</strong> {{ $pengaduan->isi_laporan }}</p>

<form method="POST" action="{{ route('tanggapan.store', $pengaduan) }}">
    @csrf
    <label>Tanggapan:</label>
    <textarea name="tanggapan" required></textarea><br>
    <button type="submit">Kirim Tanggapan</button>
</form>
@endsection
