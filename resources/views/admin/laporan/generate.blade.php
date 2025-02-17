<!DOCTYPE html>
<html>
<head>
    <title>Generate Laporan</title>
</head>
<body>
    <h1>Daftar Laporan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelapor</th>
                <th>Isi Laporan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->masyarakat->nama }}</td>
                <td>{{ $data->isi_laporan }}</td>
                <td>{{ $data->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
