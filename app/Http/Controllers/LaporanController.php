<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function dashboard()
    {
        $pengaduan = Pengaduan::where('nik', auth('masyarakat')->id())->with('tanggapan')->get();
        return view('masyarakat.dashboard', compact('pengaduan'));
    }

    // Form buat laporan
    public function create()
    {
        return view('masyarakat.pengaduan.create');
    }

    // Simpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('uploads', 'public') : null;

        Pengaduan::create([
            'nik' => Auth::user()->nik,
            'tgl_pengaduan' => Carbon::now(),
            'isi_laporan' => $request->isi_laporan,
            'foto' => $fotoPath,
            'status' => 'tunggu',
        ]);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Laporan berhasil dikirim.');
    }

    // Tampilkan laporan untuk verifikasi
    public function verifikasi()
    {
        // Cek apakah pengguna adalah admin atau petugas
        if (Auth::guard('admin')->check()) {
            $pengaduan = Pengaduan::orderBy('tgl_pengaduan', 'desc')->get();
            return view('admin.verifikasi', compact('pengaduan'));
        } elseif (Auth::guard('petugas')->check()) {
            $pengaduan = Pengaduan::where('status', 'tunggu')->orderBy('tgl_pengaduan', 'desc')->get();
            return view('petugas.verifikasi', compact('pengaduan'));
        }

        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }



    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:tunggu,proses,selesai',
        ]);

        $pengaduan = Pengaduan::where('id_pengaduan', $id)->firstOrFail();

        // Pastikan hanya admin atau petugas yang bisa mengubah status
        if (Auth::guard('admin')->check() || Auth::guard('petugas')->check()) {
            $pengaduan->update(['status' => $request->status]);

            // Redirect sesuai dengan peran pengguna
            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard')->with('success', 'Status laporan berhasil diperbarui oleh Admin.');
            } else {
                return redirect()->route('petugas.dashboard')->with('success', 'Status laporan berhasil diperbarui oleh Petugas.');
            }
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah status laporan.');
    }


}
