@extends('layouts.public')

@section('title', 'Tentang Kami - ' . ($profile->nama_sekolah ?? 'SMPN 1 Pirime'))

@section('content')

<!-- Hero Tentang Kami -->
<section class="relative bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 text-white py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[url('/images/tetang/tetang.png')] bg-cover bg-center"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 animate-bounce">
            Tentang Kami
        </h1>
        <p class="text-lg md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Mengenal lebih dekat {{ $profile->nama_sekolah ?? 'sekolah kami' }} - institutions that builds qualified generation for the future.
        </p>
    </div>
</section>

<!-- Profil Sekolah -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-2 gap-12 items-center">

        <!-- Gambar -->
        <div class="overflow-hidden rounded-3xl shadow-2xl">
            <img src="/images/bg/smp.png" alt="Gedung {{ $profile->nama_sekolah ?? 'Sekolah' }}" class="w-full h-full object-cover hover:scale-110 transition duration-700">
        </div>

        <!-- Isi -->
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                Profil {{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }}
            </h2>
            
            <!-- School Info Cards -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-xl">
                    <p class="text-sm text-blue-600 font-semibold">NPSN</p>
                    <p class="text-lg font-bold text-gray-800">{{ $profile->npsn ?? '-' }}</p>
                </div>
                <div class="bg-indigo-50 p-4 rounded-xl">
                    <p class="text-sm text-indigo-600 font-semibold">Status</p>
                    <p class="text-lg font-bold text-gray-800">{{ $profile->status ?? 'Negeri' }}</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-xl">
                    <p class="text-sm text-purple-600 font-semibold">Akreditasi</p>
                    <p class="text-lg font-bold text-gray-800">{{ $profile->akreditasi ?? 'A' }}</p>
                </div>
                <div class="bg-green-50 p-4 rounded-xl">
                    <p class="text-sm text-green-600 font-semibold">Tahun Berdiri</p>
                    <p class="text-lg font-bold text-gray-800">{{ $profile->tahun_berdiri ?? '-' }}</p>
                </div>
            </div>
            
            <p class="text-gray-600 leading-relaxed mb-4">
                {{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }} is an educational institution that is committed to 
                providing the best educational services for students. With 
                a safe, comfortable, and inspiring learning environment, this school 
                presents to produce an outstanding generation.
            </p>

            <p class="text-gray-600 leading-relaxed mb-4">
                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                {{ $profile->alamat ?? 'Alamat belum diisi' }}
            </p>

            <div class="grid grid-cols-3 gap-4 mt-6">
                <div class="bg-blue-50 p-5 rounded-2xl shadow text-center">
                    <h3 class="font-bold text-blue-700 text-xl">{{ $profile->total_siswa ?? 500 }}+</h3>
                    <p class="text-gray-600 text-sm">Active Students</p>
                </div>

                <div class="bg-indigo-50 p-5 rounded-2xl shadow text-center">
                    <h3 class="font-bold text-indigo-700 text-xl">{{ $profile->total_guru ?? 40 }}+</h3>
                    <p class="text-gray-600 text-sm">Teachers</p>
                </div>

                <div class="bg-purple-50 p-5 rounded-2xl shadow text-center">
                    <h3 class="font-bold text-purple-700 text-xl">{{ $profile->total_prestasi ?? 20 }}+</h3>
                    <p class="text-gray-600 text-sm">Achievements</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ $profile->visi ?? 'Become the best school that produces smart and moral character generation.' }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-10">

            <!-- Visi -->
            <div class="bg-white p-8 rounded-3xl shadow-lg hover:-translate-y-2 transition">
                <div class="flex items-center mb-4">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-eye text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-700">Visi</h3>
                </div>
                <p class="text-gray-600 leading-relaxed text-lg">
                    {{ $profile->visi ?? 'Terwujudnya peserta didik yang unggul dalam prestasi, berkarakter, beriman, dan mampu bersaing di era global.' }}
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white p-8 rounded-3xl shadow-lg hover:-translate-y-2 transition">
                <div class="flex items-center mb-4">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-bullseye text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-indigo-700">Misi</h3>
                </div>
                <ul class="space-y-3 text-gray-600">
                    @if($profile->misi)
                        @php
                            $misiList = is_array($profile->misi) ? $profile->misi : json_decode($profile->misi, true);
                        @endphp
                        @if(is_array($misiList))
                            @foreach($misiList as $item)
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>{{ $misiList }}</span>
                            </li>
                        @endif
                    @else
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Menyelenggarakan pembelajaran berkualitas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Menanamkan nilai disiplin dan tanggung jawab</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Mengembangkan minat dan bakat siswa</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span>Memanfaatkan teknologi dalam pendidikan</span>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- Kepala Sekolah -->
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">
@if($profile->foto_kepsek)
            <img src="{{ asset('profiles/' . $profile->foto_kepsek) }}" 
                 class="w-40 h-40 mx-auto rounded-full shadow-xl object-cover mb-6 border-4 border-blue-500">
        @else
            <img src="/images/galeri/kep injil.jpg" 
                 class="w-40 h-40 mx-auto rounded-full shadow-xl object-cover mb-6 border-4 border-blue-500">
        @endif

        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            Sambutan Kepala Sekolah
        </h2>
        
        <p class="text-gray-600 italic max-w-3xl mx-auto leading-relaxed">
            "{{ $profile->sambutan_kepsek ?? 'Kami percaya bahwa pendidikan adalah jembatan menuju masa depan. Bersama guru, siswa, dan orang tua, kami membangun generasi Papua yang hebat, cerdas, dan berdaya saing.' }}"
        </p>

        <h4 class="mt-6 font-bold text-blue-700">
            {{ $profile->kepala_sekolah ?? 'Kepala Sekolah' }}
        </h4>
        <p class="text-gray-500">Kepala {{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }}</p>
    </div>
</section>

<!-- PPDB CTA -->
<section class="py-20 bg-gradient-to-r from-indigo-700 to-blue-700 text-white text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-5">
            Join With Us
        </h2>
        <p class="text-lg text-blue-100 mb-8">
            Register now at {{ $profile->nama_sekolah ?? 'our school' }}. Prepare your future with quality education.
        </p>

        <a href="{{ route('ppdb') }}"
           class="bg-white text-blue-700 px-8 py-4 rounded-full font-bold shadow-lg hover:bg-gray-100 transition">
            Register Now
        </a>
    </div>
</section>

@endsection
