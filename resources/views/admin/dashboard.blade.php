@extends('layouts.app')

@section('content')
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<h1>Dashboard Admin</h1>
<p>Selamat datang, <strong>{{ Auth::user()->nama_admin }}</strong>!</p>

<!-- Tombol Tambah Petugas -->
<a href="{{ route('admin.petugas.create') }}" class="btn btn-primary">Tambah Petugas</a>

<!-- Statistik Laporan -->
<h2>Statistik Laporan</h2>
<ul>
    <li>Total Laporan: {{ $pengaduan->count() }}</li>
    <li>Menunggu Verifikasi: {{ $pengaduan->where('status', 'tunggu')->count() }}</li>
    <li>Dalam Proses: {{ $pengaduan->where('status', 'proses')->count() }}</li>
    <li>Selesai: {{ $pengaduan->where('status', 'selesai')->count() }}</li>
</ul>

<!-- Filter Laporan -->
<h2>Filter Laporan</h2>
<form method="GET" action="{{ route('admin.dashboard') }}">
    <label for="filter_status">Status:</label>
    <select name="filter_status" id="filter_status" onchange="this.form.submit()">
        <option value="" {{ request('filter_status') == '' ? 'selected' : '' }}>Semua</option>
        <option value="tunggu" {{ request('filter_status') == 'tunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
        <option value="proses" {{ request('filter_status') == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
        <option value="selesai" {{ request('filter_status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
</form>

<h2>Cari Laporan</h2>
<form method="GET" action="{{ route('admin.dashboard') }}">
    <label for="start_date">Dari:</label>
    <input type="date" name="start_date" value="{{ request('start_date') }}">

    <label for="end_date">Sampai:</label>
    <input type="date" name="end_date" value="{{ request('end_date') }}">

    <button type="submit">Filter</button>
</form>

<!-- Daftar Laporan -->
<h2>Daftar Laporan Pengaduan</h2>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelapor</th>
            <th>Isi Laporan</th>
            <th>Lokasi</th>
            <th>Kategori</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pengaduan as $index => $data)
        <tr>
            <td>{{ $index + 1 + ($pengaduan->currentPage() - 1) * $pengaduan->perPage() }}</td>
            <td>{{ $data->tgl_pengaduan }}</td>
            <td>{{ $data->masyarakat->nama }}</td>
            <td>{{ $data->isi_laporan }}</td>
            <td>{{ $data->lokasi }}</td>
            <td>{{ $data->kategori }}</td>
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
                <!-- Form Update Status -->
                <form method="POST" action="{{ route('admin.verifikasi.update', $data->id_pengaduan) }}">
                    @csrf
                    <select name="status">
                        <option value="tunggu" {{ $data->status == 'tunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ $data->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit">Update</button>
                </form>

                <!-- Tombol Tanggapan -->
                <a href="{{ route('admin.tanggapan.show', $data->id_pengaduan) }}">Beri Tanggapan</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align: center;">Tidak ada laporan</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div style="margin-top: 10px;">
    {{ $pengaduan->links() }}
</div>

<!-- Logout -->
<a href="{{ route('logout') }}" class="btn btn-danger"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection
