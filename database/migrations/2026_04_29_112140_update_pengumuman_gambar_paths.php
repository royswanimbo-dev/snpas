<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('pengumumans')
            ->whereNotNull('gambar')
            ->where('gambar', 'NOT LIKE', 'pengumuman/%')
            ->update(['gambar' => DB::raw("CONCAT('pengumuman/', gambar)")]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pengumumans')
            ->where('gambar', 'LIKE', 'pengumuman/%')
            ->update(['gambar' => DB::raw("REPLACE(gambar, 'pengumuman/', '')")]);
    }
};
