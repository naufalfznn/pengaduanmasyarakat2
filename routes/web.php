<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PetugasController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login dan Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard masing-masing pengguna
Route::middleware('auth:masyarakat')->group(function () {
    Route::get('/masyarakat/dashboard', function () {
        return view('masyarakat.dashboard');
    })->name('masyarakat.dashboard');
});

// Dashboard Admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Verifikasi & Validasi Laporan
    Route::get('/admin/verifikasi', [LaporanController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::post('/admin/verifikasi/{id}', [LaporanController::class, 'updateStatus'])->name('admin.verifikasi.update');

    // Tanggapan Admin
    Route::get('/admin/tanggapan/{pengaduan}', [TanggapanController::class, 'show'])->name('admin.tanggapan.show');
    Route::post('/admin/tanggapan/{pengaduan}', [TanggapanController::class, 'store'])->name('admin.tanggapan.store');

    // Generate Laporan
    Route::get('/admin/generate-laporan', [LaporanController::class, 'generate'])->name('admin.generate-laporan');
});


Route::middleware('auth:petugas')->group(function () {
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');
});

Route::get('/masyarakat/dashboard', [LaporanController::class, 'dashboard'])
    ->name('masyarakat.dashboard')
    ->middleware('auth:masyarakat');


// Verifikasi dan Validasi (Admin & Petugas)
Route::middleware(['auth:admin', 'auth:petugas'])->group(function () {
    Route::get('/verifikasi', [LaporanController::class, 'verifikasi'])->name('verifikasi.index');
    Route::post('/verifikasi/{id}', [LaporanController::class, 'updateStatus'])->name('verifikasi.update');
});


// Tanggapan (Admin & Petugas)
Route::middleware(['auth:admin,petugas'])->group(function () {
    Route::get('/tanggapan/{pengaduan}', [TanggapanController::class, 'show'])->name('tanggapan.show');
    Route::post('/tanggapan/{pengaduan}', [TanggapanController::class, 'store'])->name('tanggapan.store');
});

// Generate Laporan (Admin)
Route::middleware('auth:admin')->group(function () {
    Route::get('/generate-pengaduan', [LaporanController::class, 'generate'])->name('pengaduan.generate');
});

// Rute untuk masyarakat membuat laporan
Route::middleware('auth:masyarakat')->group(function () {
    Route::get('/pengaduan/create', [LaporanController::class, 'create'])->name('pengaduan.create'); // Form buat laporan
    Route::post('/pengaduan', [LaporanController::class, 'store'])->name('pengaduan.store'); // Simpan laporan
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create');
    Route::post('/admin/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store');
});
