@extends('layouts.public')

@section('title', 'WEBSITE PPDB SMPN 1 PIRIME - Pendaftaran Online')

@section('content')

<!-- HERO SECTION -->
<section class="relative min-h-screen overflow-hidden flex items-center">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bg/smp.png') }}"
             class="w-full h-full object-cover object-center scale-110"
             alt="Background SMP">
    </div>

    <!-- Overlay Premium -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-blue-950/65 to-indigo-950/80"></div>

    <!-- Glow -->
    <div class="absolute -top-20 -left-20 w-[500px] h-[500px] bg-blue-500/20 blur-[140px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/20 blur-[140px] rounded-full"></div>

    <!-- Grid -->
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right,#fff 1px,transparent 1px),linear-gradient(to bottom,#fff 1px,transparent 1px);background-size:40px 40px;">
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 py-24 grid lg:grid-cols-2 gap-16 items-center">

        <!-- Left -->
        <div class="text-center lg:text-left">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 backdrop-blur-xl px-5 py-2 rounded-full text-white text-sm font-semibold shadow-xl mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-ping"></span>
                PPDB Dibuka Tahun {{ date('Y') }}/{{ date('Y')+1 }}
            </div>

            <!-- Title -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black leading-tight text-white">
                WEBSITE PPDB
                <span class="block text-yellow-400 drop-shadow-lg">
                    SMPN 1 PIRIME
                </span>
            </h1>

            <!-- Desc -->
            <p class="mt-6 text-lg sm:text-xl text-slate-200 leading-relaxed max-w-2xl">
                Sistem pendaftaran siswa baru berbasis digital modern.
                Proses lebih cepat, aman, transparan, dan bisa diakses kapan saja.
            </p>

            <!-- Button -->
            <div class="mt-10 flex flex-col sm:flex-row gap-5 justify-center lg:justify-start">

                <a href="{{ route('register.form') }}"
                   class="group px-8 py-4 rounded-2xl bg-gradient-to-r from-yellow-400 to-orange-400 text-slate-900 font-bold shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-3 group-hover:rotate-12 transition"></i>
                    Daftar Sekarang
                </a>

                <a href="{{ route('login.form') }}"
                   class="px-8 py-4 rounded-2xl border border-white/40 bg-white/10 backdrop-blur-md text-white font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Login
                </a>

            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 mt-12">

                <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-2xl p-4 text-center">
                    <h3 class="text-2xl font-black text-yellow-400">100%</h3>
                    <p class="text-sm text-gray-200">Online</p>
                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-2xl p-4 text-center">
                    <h3 class="text-2xl font-black text-green-400">24 Jam</h3>
                    <p class="text-sm text-gray-200">Akses</p>
                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-2xl p-4 text-center">
                    <h3 class="text-2xl font-black text-cyan-400">Aman</h3>
                    <p class="text-sm text-gray-200">Data</p>
                </div>

            </div>

        </div>

        <!-- Right -->
        <div class="hidden lg:flex justify-center">
            <div class="relative">

                <!-- Circle Glow -->
                <div class="absolute inset-0 bg-blue-500/20 blur-[90px] rounded-full scale-125"></div>

                <!-- Image -->
                <img src="{{ asset('images/logo/siswa-smp-sd.png') }}"
                     class="relative w-[430px] animate-float drop-shadow-[0_30px_70px_rgba(0,0,0,0.6)]"
                     alt="Siswa">

                <!-- Floating Box -->
                <div class="absolute top-6 -left-10 bg-white rounded-2xl shadow-2xl px-5 py-3">
                    <p class="font-bold text-gray-800">🎓 Siswa Baru</p>
                    <small class="text-gray-500">Siap Belajar</small>
                </div>

                <div class="absolute bottom-8 -right-8 bg-yellow-400 rounded-2xl shadow-2xl px-5 py-3">
                    <p class="font-bold text-gray-900">🚀 Daftar Mudah</p>
                    <small class="text-gray-700">Cepat & Praktis</small>
                </div>

            </div>
        </div>

    </div>

    <!-- Scroll Icon -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white animate-bounce">
        <i class="fas fa-angle-down text-2xl"></i>
    </div>

</section>


<!-- FITUR -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="text-4xl font-black text-slate-800 mb-4">
                Kenapa Pilih SMPN 1 PIRIME?
            </h2>
            <p class="text-gray-600 text-lg">
                Pendidikan berkualitas dengan sistem pendaftaran modern.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white rounded-3xl p-8 shadow-xl hover:-translate-y-2 transition-all">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-5">
                    <i class="fas fa-laptop"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Pendaftaran Online</h3>
                <p class="text-gray-600">Daftar dari HP tanpa perlu datang ke sekolah.</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-xl hover:-translate-y-2 transition-all">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl mb-5">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Data Aman</h3>
                <p class="text-gray-600">Sistem penyimpanan aman dan profesional.</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-xl hover:-translate-y-2 transition-all">
                <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center text-2xl mb-5">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Cepat Diproses</h3>
                <p class="text-gray-600">Verifikasi dan seleksi lebih efisien.</p>
            </div>

        </div>

    </div>
</section>


<!-- CTA -->
<section class="py-24 bg-gradient-to-r from-blue-700 to-indigo-800 text-white text-center">
    <div class="max-w-4xl mx-auto px-6">

        <h2 class="text-4xl font-black mb-5">
            Siap Bergabung Bersama Kami?
        </h2>

        <p class="text-lg text-blue-100 mb-10">
            Daftarkan diri sekarang dan raih masa depan cerah bersama SMPN 1 PIRIME.
        </p>

        <a href="{{ route('register.form') }}"
           class="inline-block bg-yellow-400 text-slate-900 px-10 py-4 rounded-2xl font-bold shadow-xl hover:scale-105 transition">
            <i class="fas fa-rocket mr-2"></i>
            Mulai Daftar 
        </a>

    </div>
</section>


<!-- WA FLOAT -->
@php
$waPhone = '6282120445529';
$waMessage = 'Halo Admin PPDB, saya ingin bertanya tentang pendaftaran.';
@endphp

<a href="https://wa.me/{{ $waPhone }}?text={{ urlencode($waMessage) }}"
   target="_blank"
   class="fixed bottom-6 right-6 w-16 h-16 rounded-full bg-green-500 text-white flex items-center justify-center shadow-2xl text-2xl hover:scale-110 transition z-50">
    <i class="fab fa-whatsapp"></i>
</a>

@endsection