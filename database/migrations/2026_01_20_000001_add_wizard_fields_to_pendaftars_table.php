<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->string('no_hp_orang_tua', 20)->nullable()->after('penghasilan_orangtua');
            $table->text('alamat_orang_tua')->nullable()->after('no_hp_orang_tua');
            $table->string('tahun_lulus', 4)->nullable()->after('alamat_sekolah');
            $table->decimal('nilai_rata_rata', 5, 2)->nullable()->after('tahun_lulus');
            $table->string('nomor_ijazah', 100)->nullable()->after('nilai_rata_rata');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn(['no_hp_orang_tua', 'alamat_orang_tua', 'tahun_lulus', 'nilai_rata_rata', 'nomor_ijazah']);
        });
    }
};

