<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
$table->id();
            $table->string('nama_sekolah');
            $table->string('npsn');
            $table->string('status');
            $table->string('akreditasi');
            $table->year('tahun_berdiri');
            $table->string('kepala_sekolah');
            $table->text('alamat');
            $table->text('sambutan_kepsek');
            $table->text('visi');
            $table->text('misi')->nullable();
            $table->string('foto_kepsek')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
