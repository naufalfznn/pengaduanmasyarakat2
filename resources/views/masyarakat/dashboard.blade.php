@extends('layouts.app')

@section('content')
<h1>Dashboard Masyarakat</h1>
<p>Selamat datang, <strong>{{ Auth::user()->nama }}</strong>!</p>

<!-- Tombol Tambah Laporan -->
<a href="{{ route('pengaduan.create') }}" class="btn btn-primary">Buat Laporan Baru</a>

<h2>Laporan Anda</h2>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Isi Laporan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Tanggapan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengaduan as $index => $data)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $data->isi_laporan }}</td>
            <td>
            @if ($data->foto)
                <img src="{{ asset('storage/' . $data->foto) }}" width="100">
            @else
                Tidak ada foto
            @endif

            </td>
            <td>
                @if ($data->status == 'tunggu')
                    <span style="color: red;">Menunggu Verifikasi</span>
                @elseif ($data->status == 'proses')
                    <span style="color: orange;">Sedang Diproses</span>
                @else
                    <span style="color: green;">Selesai</span>
                @endif
            </td>
            <td>
                @if ($data->tanggapan)
                    {{ $data->tanggapan->tanggapan }}
                @else
                    Belum ada tanggapan
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Logout -->
<a href="{{ route('logout') }}" class="btn btn-danger"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection
