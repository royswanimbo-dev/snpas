@extends('layouts.app')

@section('title', 'PPDB SMPN 1 Pirime - Penerimaan Peserta Didik Baru')

@section('content')
@php
    $pengumumans = App\Models\Pengumuman::aktif()->terbaru()->take(5)->get();
@endphp

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-800 text-white pt-28 overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center opacity-20"></div>
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="container relative z-10 text-center py-20">
        <div class="max-w-4xl mx-auto">
            <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo SMPN 1 Pirime" class="mx-auto h-32 w-32 rounded-3xl shadow-2xl mb-8 animate-float">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                PPDB Online SMPN 1 Pirime
            </h1>
            <p class="text-xl opacity-95 max-w-2xl mx-auto leading-relaxed mb-8">
                Penerimaan Peserta Didik Baru Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register.form') }}" class="bg-white text-blue-600 px-8 py-4 rounded-2xl font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('login.form') }}" class="border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Pengumuman Terbaru -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Pengumuman Terbaru</h2>
            <p class="text-gray-600">Informasi terkini seputar PPDB SMPN 1 Pirime</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pengumumans as $pengumuman)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-semibold">
                            {{ $pengumuman->created_at->format('d M Y') }}
                        </span>
                        @if($pengumuman->is_important)
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold">Penting</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $pengumuman->judul }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ strip_tags($pengumuman->isi) }}</p>
                    <a href="{{ route('pengumuman.show', $pengumuman->id) }}" class="text-blue-600 font-semibold text-sm hover:text-blue-800 transition-colors">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-bullhorn text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada pengumuman</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Info PPDB -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Alur Pendaftaran</h2>
            <p class="text-gray-600">Langkah-langkah mudah mendaftar PPDB Online</p>
        </div>
        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">1</div>
                <h3 class="font-bold text-gray-800 mb-2">Buat Akun</h3>
                <p class="text-gray-600 text-sm">Daftar dengan email aktif dan lengkapi data diri</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">2</div>
                <h3 class="font-bold text-gray-800 mb-2">Isi Formulir</h3>
                <p class="text-gray-600 text-sm">Lengkapi formulir pendaftaran dengan data yang valid</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">3</div>
                <h3 class="font-bold text-gray-800 mb-2">Upload Berkas</h3>
                <p class="text-gray-600 text-sm">Unggah dokumen persyaratan yang diperlukan</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-4 shadow-lg">4</div>
                <h3 class="font-bold text-gray-800 mb-2">Cetak Bukti</h3>
                <p class="text-gray-600 text-sm">Cetak bukti pendaftaran dan tunggu verifikasi</p>
            </div>
        </div>
    </div>
</section>
@endsection

