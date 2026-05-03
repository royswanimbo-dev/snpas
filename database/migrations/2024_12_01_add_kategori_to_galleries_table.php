<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->enum('kategori', ['Kegiatan', 'Prestasi', 'Fasilitas', 'Guru', 'Siswa', 'Lainnya'])->default('Kegiatan')->after('image');
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};

