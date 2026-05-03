<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPDBController;
use App\Models\Pengumuman;

/*
|--------------------------------------------------------------------------
| API Routes for Pengumuman Modal
|--------------------------------------------------------------------------
*/

Route::get('/pengumuman/{id}', function ($id) {
    $pengumuman = Pengumuman::findOrFail($id);
    
    return response()->json([
        'id' => $pengumuman->id,
        'judul' => $pengumuman->judul,
        'isi' => $pengumuman->isi,
'gambar' => $pengumuman->gambar ? asset('storage/' . $pengumuman->gambar) : null,
        'jenis' => $pengumuman->jenis,
        'tanggal_publish' => $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y H:i') : $pengumuman->created_at->format('d M Y H:i'),
    ]);
})->name('api.pengumuman.show');
