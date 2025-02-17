<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Masyarakat;

class AuthController extends Controller
{
    // Tampilkan form registrasi masyarakat
    public function showRegisterForm()
    {
        return view('auth.register'); // Sesuai struktur di folder auth
    }

    // Proses registrasi masyarakat
    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|size:16|unique:masyarakat,nik',
            'nama' => 'required|max:35',
            'username' => 'required|max:25|unique:masyarakat,username',
            'password' => 'required|min:8|confirmed',
            'telp' => 'required|max:13',
            'email' => 'nullable|email|unique:masyarakat,email',
            'alamat' => 'nullable|string',
        ]);

        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Pastikan password di-hash
            'telp' => $request->telp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Sesuai struktur di folder auth
    }

     // Proses login
     public function login(Request $request)
     {
         $request->validate([
             'username' => 'required',
             'password' => 'required',
         ]);
 
         $credentials = $request->only('username', 'password');
 
         // Cek login untuk masyarakat
         if (Auth::guard('masyarakat')->attempt($credentials)) {
             return redirect()->route('masyarakat.dashboard');
         }
 
         // Cek login untuk admin
         if (Auth::guard('admin')->attempt($credentials)) {
             return redirect()->route('admin.dashboard');
         }
 
         // Cek login untuk petugas
         if (Auth::guard('petugas')->attempt($credentials)) {
             return redirect()->route('petugas.dashboard');
         }
 
         // Jika gagal
         return back()->withErrors(['loginError' => 'Username atau password salah.']);
     }
 
     // Proses logout
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect()->route('homepage');
     }
}
