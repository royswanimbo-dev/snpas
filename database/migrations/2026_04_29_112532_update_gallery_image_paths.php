<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('galleries')
            ->whereNotNull('image')
            ->where('image', 'NOT LIKE', 'gallery/%')
            ->update(['image' => DB::raw("CONCAT('gallery/', image)")]);
    }

    public function down(): void
    {
        DB::table('galleries')
            ->where('image', 'LIKE', 'gallery/%')
            ->update(['image' => DB::raw("REPLACE(image, 'gallery/', '')")]);
    }
};
