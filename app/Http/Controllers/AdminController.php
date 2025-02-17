<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Query awal dengan relasi masyarakat
        $query = Pengaduan::with('masyarakat');

        // Perbaikan: Hanya filter jika filter_status memiliki nilai
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // Tambahkan paginasi untuk membatasi data per halaman
        $pengaduan = $query->paginate(10);

        // Return ke view dengan data laporan
        return view('admin.dashboard', [
            'pengaduan' => $pengaduan,
            'filter_status' => $request->filter_status ?? '' 
        ]);
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_pengaduan', [$request->start_date, $request->end_date]);
        }
        
    }

}
