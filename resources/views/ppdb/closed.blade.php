@extends('layouts.public')

@section('title', $title ?? 'Pendaftaran Ditutup')

@section('content')
<section class="pt-28 pb-20 relative bg-gradient-to-br from-red-900 via-rose-900 to-purple-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('/images/bg/smp.png')] bg-cover bg-center"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <div class="mb-6">
            <div class="w-20 h-20 mx-auto rounded-3xl bg-white/10 backdrop-blur-xl flex items-center justify-center shadow-2xl">
                <i class="fas fa-lock text-4xl text-red-200"></i>
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">{{ $title ?? 'Pendaftaran Ditutup' }}</h1>
        <p class="text-lg md:text-2xl text-red-100 leading-relaxed mb-10">{{ $message ?? 'Pendaftaran siswa baru sedang ditutup.' }}</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="bg-white text-red-900 px-8 py-4 rounded-3xl font-bold text-lg shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300">
                Kembali ke Beranda
            </a>
            <a href="{{ route('pengumuman') }}" class="border-4 border-white/80 text-white px-8 py-4 rounded-3xl font-bold text-lg hover:bg-white/10 transition-all duration-300">
                Lihat Pengumuman
            </a>
        </div>
    </div>
</section>
@endsection

