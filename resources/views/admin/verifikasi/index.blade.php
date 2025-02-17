<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelapor</th>
            <th>Isi Laporan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengaduan as $index => $laporan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $laporan->tgl_pengaduan }}</td>
            <td>{{ $laporan->masyarakat->nama }}</td>
            <td>{{ $laporan->isi_laporan }}</td>
            <td>{{ ucfirst($laporan->status) }}</td>
            <td>
                <form method="POST" action="{{ route('verifikasi.update', $laporan->id_pengaduan) }}">
                    @csrf
                    <select name="status">
                        <option value="tunggu" {{ $laporan->status == 'tunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
