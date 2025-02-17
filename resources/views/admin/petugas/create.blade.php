@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Petugas</h2>
    <form action="{{ route('admin.petugas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Petugas</label>
            <input type="text" name="nama_petugas" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telp" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
