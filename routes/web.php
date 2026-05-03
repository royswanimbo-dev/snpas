<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PPDBController;
/*
|--------------------------------------------------------------------------
| HALAMAN HOME
|--------------------------------------------------------------------------
*/

// Halaman Home
Route::get('/', [PPDBController::class, 'home'])->name('home');

// Profil Sekolah
Route::get('/profil', [PPDBController::class, 'profil'])->name('profil');

// Kesiswaan
Route::get('/kesiswaan', [PPDBController::class, 'kesiswaan'])->name('kesiswaan');

// Pengumuman
Route::get('/pengumuman', [PPDBController::class, 'pengumuman'])->name('pengumuman');
Route::get('/pengumuman/{id}', [PPDBController::class, 'showPengumuman'])->name('pengumuman.show');

// Galeri
Route::get('/galeri', [PPDBController::class, 'galeri'])->name('galeri');

// Kontak
Route::get('/kontak', [PPDBController::class, 'kontak'])->name('kontak');

// Guru
Route::get('/guru', [PPDBController::class, 'guru'])->name('guru');

// PPDB
Route::get('/ppdb', [PPDBController::class, 'ppdb'])->name('ppdb');

/*
|--------------------------------------------------------------------------
| AUTH (Login, Register, Logout)
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA
|--------------------------------------------------------------------------
| Akses hanya untuk pengguna dengan role = siswa
*/

Route::middleware(['auth', 'role:siswa'])->group(function () {

    // Dashboard
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])
        ->name('siswa.dashboard');

    // Formulir PPDB
    Route::get('/siswa/pendaftaran', [SiswaController::class, 'formPendaftaran'])
        ->name('siswa.pendaftaran');

    // Simpan data PPDB
    Route::post('/siswa/pendaftaran/simpan', [SiswaController::class, 'simpanPendaftaran'])
        ->name('siswa.pendaftaran.simpan');

    // Upload Berkas
    Route::get('/siswa/ppdb/berkas', [SiswaController::class, 'berkas'])
        ->name('siswa.ppdb.berkas');

    Route::post('/siswa/ppdb/berkas/upload', [SiswaController::class, 'uploadBerkas'])
        ->name('siswa.ppdb.berkas.upload');

    // Pengumuman
    Route::get('/siswa/pengumuman', [SiswaController::class, 'pengumuman'])
        ->name('siswa.pengumuman');

    // Status Pendaftaran
    Route::get('/siswa/status', [SiswaController::class, 'status'])
        ->name('siswa.status');

    // Cetak Bukti Pendaftaran PDF
    Route::get('/siswa/cetak', [SiswaController::class, 'cetakPdf'])
        ->name('siswa.cetak');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
| Akses hanya untuk user role = admin
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard-admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Semua data pendaftar
    Route::get('/admin/pendaftar', [AdminController::class, 'pendaftar'])
        ->name('admin.pendaftar');

    // Detail pendaftar
    Route::get('/admin/detail/{id}', [AdminController::class, 'detailPendaftar'])
        ->name('admin.detail');

    // Verifikasi data
    Route::post('/admin/verifikasi/{id}', [AdminController::class, 'verifikasi'])
        ->name('admin.verifikasi');

    // Laporan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])
        ->name('admin.laporan');
    
    // Pengaturan
    Route::get('/admin/pengaturan', [AdminController::class, 'pengaturan'])
        ->name('admin.pengaturan');
    Route::put('/admin/profil/update', [AdminController::class, 'updateProfil'])
        ->name('admin.profil.update');

    // Pengumuman Management
    Route::get('/admin/pengumuman', [AdminController::class, 'pengumuman'])
        ->name('admin.pengumuman');
    Route::get('/admin/pengumuman/buat', [AdminController::class, 'buatPengumuman'])
        ->name('admin.pengumuman.buat');
    Route::post('/admin/pengumuman/simpan', [AdminController::class, 'simpanPengumuman'])
        ->name('admin.pengumuman.simpan');
    Route::get('/admin/pengumuman/edit/{id}', [AdminController::class, 'editPengumuman'])
        ->name('admin.pengumuman.edit');
    Route::put('/admin/pengumuman/update/{id}', [AdminController::class, 'updatePengumuman'])
        ->name('admin.pengumuman.update');
    Route::delete('/admin/pengumuman/hapus/{id}', [AdminController::class, 'hapusPengumuman'])
        ->name('admin.pengumuman.hapus');
    Route::post('/admin/pengumuman/toggle/{id}', [AdminController::class, 'togglePengumuman'])
        ->name('admin.pengumuman.toggle');

    // Gallery Management
    Route::get('/admin/gallery', [AdminController::class, 'gallery'])->name('admin.gallery.index');
    Route::get('/admin/gallery/create', [AdminController::class, 'createGallery'])->name('admin.gallery.create');
    Route::post('/admin/gallery', [AdminController::class, 'storeGallery'])->name('admin.gallery.store');
    Route::get('/admin/gallery/{gallery}/edit', [AdminController::class, 'editGallery'])->name('admin.gallery.edit');
    Route::put('/admin/gallery/{gallery}', [AdminController::class, 'updateGallery'])->name('admin.gallery.update');
    Route::delete('/admin/gallery/{gallery}', [AdminController::class, 'destroyGallery'])->name('admin.gallery.destroy');
});

// API Routes for Chatbot
Route::prefix('api')->group(function () {
    Route::get('/cek-status-pendaftaran', [PPDBController::class, 'cekStatusPendaftaran'])
        ->name('api.cek-status-pendaftaran');
});

