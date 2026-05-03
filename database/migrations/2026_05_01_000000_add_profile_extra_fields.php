<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('ppdb_open')->default(true)->after('foto_kepsek');
            $table->integer('total_siswa')->default(500)->after('ppdb_open');
            $table->integer('total_guru')->default(40)->after('total_siswa');
            $table->integer('total_prestasi')->default(20)->after('total_guru');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['ppdb_open', 'total_siswa', 'total_guru', 'total_prestasi']);
        });
    }
};
