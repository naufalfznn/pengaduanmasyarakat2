<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Auth;

class TanggapanController extends Controller
{
    public function show(Pengaduan $pengaduan)
    {
        // Tentukan view berdasarkan role
        $view = Auth::guard('admin')->check() ? 'admin.tanggapan.create' : 'petugas.tanggapan.create';

        return view($view, compact('pengaduan'));
    }

    public function store(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'tanggapan' => 'required',
        ]);

        // Tambahkan tanggapan ke database
        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id_pengaduan, // Pastikan kolomnya benar
            'petugas_id' => Auth::guard('admin')->check() ? Auth::id() : Auth::id(),
            'tanggapan' => $request->tanggapan,
        ]);

        // Hanya ubah status menjadi "selesai" jika laporan sudah dalam status "proses"
        if ($pengaduan->status == 'proses') {
            $pengaduan->update(['status' => 'selesai']);
        } else {
            $pengaduan->update(['status' => 'proses']); // Jika belum "proses", ubah jadi "proses" dulu
        }

        return redirect()->route('verifikasi.index')->with('success', 'Tanggapan berhasil diberikan.');
    }

}
