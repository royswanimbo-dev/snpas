<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Response;

class PPDBGate
{
    public static function ensurePpdbOpen()
    {
        $profile = Profile::first();
        $open = (bool) ($profile->ppdb_open ?? true);

        if (!$open) {
            return response()->view('ppdb.closed', [
                'title' => 'Pendaftaran Ditutup',
                'message' => 'Pendaftaran siswa baru sedang ditutup. Mohon coba kembali pada periode pendaftaran berikutnya.'
            ], 403);
        }

        return null;
    }
}

