@extends('layouts.public')

@section('title', 'PPDB Online - SMPN 1 Pirime')

@section('content')
<!-- Hero Section -->
<section class="pt-28 pb-20 relative bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 text-white overflow-hidden">
   <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center bg-no-repeat"></div>
    <div class="relative z-10 py-24 px-4 max-w-7xl mx-auto text-center">
          <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}"
             alt="Logo SMPN Pirime"
             class="mx-auto h-32 w-32 md:h-40 md:w-40 rounded-3xl shadow-2xl mb-8 animate-float">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent drop-shadow-2xl">
            PPDB Online
        </h1>
        <p class="text-xl md:text-3xl opacity-90 max-w-3xl mx-auto leading-relaxed mb-10">
            Penerimaan Peserta Didik Baru <span class="text-yellow-400 font-bold">{{ date('Y') }}/{{ date('Y')+1 }}</span>
        </p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center max-w-2xl mx-auto">
            <a href="{{ route('register.form') }}" 
               class="bg-white text-blue-600 px-12 py-6 rounded-3xl font-bold text-xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 flex items-center">
                <i class="fas fa-user-plus mr-3 text-2xl"></i>Daftar Sekarang
            </a>
            <a href="{{ route('login.form') }}" 
               class="border-4 border-white text-white px-12 py-6 rounded-3xl font-bold text-xl hover:bg-white hover:text-blue-600 transition-all duration-300 flex items-center">
                <i class="fas fa-sign-in-alt mr-3 text-xl"></i>Login Pendaftar
            </a>
        </div>
    </div>
</section>

<!-- Persyaratan Section -->
<section class="py-24 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Persyaratan Pendaftaran</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Siapkan dokumen-dokumen ini sebelum mendaftar</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group bg-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 hover:bg-blue-50">
                <div class="w-20 h-20 bg-blue-100 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-file-alt text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Akta Kelahiran</h3>
                <p class="text-gray-600 text-center">Fotokopi akta kelahiran asli yang sah</p>
            </div>

            <div class="group bg-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 hover:bg-emerald-50">
                <div class="w-20 h-20 bg-emerald-100 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-emerald-200 transition-colors">
                    <i class="fas fa-id-card text-3xl text-emerald-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Kartu Keluarga</h3>
                <p class="text-gray-600 text-center">Fotokopi Kartu Keluarga (KK) terbaru</p>
            </div>

            <div class="group bg-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 hover:bg-purple-50">
                <div class="w-20 h-20 bg-purple-100 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-200 transition-colors">
                    <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Rapor Semester 5 & 6</h3>
                <p class="text-gray-600 text-center">Fotokopi rapor SD/MI semester 5 dan 6</p>
            </div>

            <div class="group bg-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 hover:-translate-y-4 hover:bg-orange-50">
                <div class="w-20 h-20 bg-orange-100 rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-200 transition-colors">
                    <i class="fas fa-camera text-3xl text-orange-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Pas Foto 3x4</h3>
                <p class="text-gray-600 text-center">4 lembar pas foto ukuran 3x4 latar merah</p>
            </div>
        </div>
    </div>
</section>

<!-- Alur Pendaftaran -->
<section class="py-24 bg-gradient-to-r from-indigo-50 via-blue-50 to-purple-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Alur Pendaftaran PPDB</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Ikuti langkah-langkah sederhana ini untuk mendaftar</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-8 items-center">
            <div class="lg:col-span-1 text-center lg:text-left">
                <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-3xl flex items-center justify-center mx-auto lg:mx-0 shadow-2xl mb-6">
                    <i class="fas fa-1 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">1. Daftar Online</h3>
                <p class="text-lg text-gray-600">Isi formulir pendaftaran secara online dan dapatkan nomor pendaftaran</p>
            </div>

            <div class="lg:col-span-1 text-center lg:text-left">
                <div class="w-24 h-24 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-3xl flex items-center justify-center mx-auto lg:mx-0 shadow-2xl mb-6">
                    <i class="fas fa-2 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">2. Upload Dokumen</h3>
                <p class="text-lg text-gray-600">Unggah scan dokumen persyaratan sesuai ketentuan</p>
            </div>

            <div class="lg:col-span-1 text-center lg:text-left">
                <div class="w-24 h-24 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-3xl flex items-center justify-center mx-auto lg:mx-0 shadow-2xl mb-6">
                    <i class="fas fa-3 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">3. Verifikasi</h3>
                <p class="text-lg text-gray-600">Tim admin akan memverifikasi kelengkapan berkas Anda</p>
            </div>

            <div class="lg:col-span-1 text-center lg:text-left">
                <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-3xl flex items-center justify-center mx-auto lg:mx-0 shadow-2xl mb-6">
                    <i class="fas fa-4 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">4. Pengumuman</h3>
                <p class="text-lg text-gray-600">Cek hasil seleksi melalui nomor pendaftaran</p>
            </div>

            <div class="lg:col-span-1 text-center lg:text-left">
                <div class="w-24 h-24 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-3xl flex items-center justify-center mx-auto lg:mx-0 shadow-2xl mb-6">
                    <i class="fas fa-check-double text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">5. Daftar Ulang</h3>
                <p class="text-lg text-gray-600">Lakukan daftar ulang di sekolah dengan membawa dokumen asli</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-28 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-5xl font-bold mb-8 drop-shadow-2xl">Siap Masuk SMPN 1 Pirime?</h2>
        <p class="text-2xl opacity-90 mb-12 max-w-2xl mx-auto leading-relaxed drop-shadow-xl">Jangan lewatkan kesempatan emas ini. Daftar sekarang dan wujudkan cita-cita pendidikan terbaik!</p>
        <div class="flex flex-col lg:flex-row gap-6 justify-center items-center">
            <a href="{{ route('register.form') }}" 
               class="bg-white text-blue-600 px-16 py-8 rounded-3xl font-bold text-2xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-500 flex items-center mx-auto lg:mx-0">
                <i class="fas fa-rocket mr-4 text-3xl"></i>Mulai Pendaftaran
            </a>
            <a href="https://wa.me/6282120445529?text=Halo%20Admin%20PPDB%20SMPN%201%20Pirime" target="_blank"
               class="border-4 border-white text-white px-16 py-8 rounded-3xl font-bold text-2xl hover:bg-white hover:text-blue-600 transition-all duration-500 flex items-center mx-auto lg:mx-0">
                <i class="fab fa-whatsapp mr-4 text-3xl"></i>Hubungi WA
            </a>
        </div>
    </div>
</section>

@endsection

