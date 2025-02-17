@extends('layouts.app')

@section('content')
<h1>Verifikasi Laporan</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelapor</th>
            <th>Isi Laporan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengaduan as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->masyarakat->nama }}</td>
            <td>{{ $data->isi_laporan }}</td>
            <td>{{ $data->status }}</td>
            <td>
                <form method="POST" action="{{ route('verifikasi.update', $data->id) }}">
                    @csrf
                    <select name="status" required>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
