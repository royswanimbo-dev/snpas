<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'npsn', 
        'status',
        'akreditasi',
        'tahun_berdiri',
        'kepala_sekolah',
        'alamat',
        'sambutan_kepsek',
        'visi',
        'misi',
        'foto_kepsek',
        'ppdb_open',
        'total_siswa',
        'total_guru',
        'total_prestasi'
    ];

    protected $casts = [
        'misi' => 'array',
        'tahun_berdiri' => 'integer',
        'ppdb_open' => 'boolean',
        'total_siswa' => 'integer',
        'total_guru' => 'integer',
        'total_prestasi' => 'integer'
    ];
}
