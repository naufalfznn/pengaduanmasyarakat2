<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba login sebagai masyarakat
        if (Auth::guard('masyarakat')->attempt($request->only('username', 'password'))) {
            return redirect()->intended('/dashboard');
        }

        // Coba login sebagai admin
        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->intended('/admin/dashboard');
        }

        // Coba login sebagai petugas
        if (Auth::guard('petugas')->attempt($request->only('username', 'password'))) {
            return redirect()->intended('/petugas/dashboard');
        }

        // Jika semua gagal
        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
