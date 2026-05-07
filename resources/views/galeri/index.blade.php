@extends('layouts.public')

@section('title', 'Galeri Foto - SMPN 1 Pirime')

@section('content')

@php
use Illuminate\Support\Facades\Storage;
@endphp

<!-- HERO SECTION -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-black text-white">

    <!-- Background Image -->
    <div class="absolute inset-0">

        <img src="/images/bg/smp.png"
             alt="SMP Negeri 1 Pirime"
             class="w-full h-full object-cover scale-110 animate-bg">

    </div>

    <!-- Overlay + Gradient: dibuat tipis supaya gambar bg tetap tampil kilat jelas -->
    <div class="absolute inset-0 bg-black/10"></div>

    <div class="absolute inset-0 bg-gradient-to-br from-blue-950/20 via-black/10 to-cyan-950/20"></div>

    <!-- Glow -->
    <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-cyan-500/20 rounded-full blur-[150px] animate-pulse"></div>

    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[150px] animate-pulse"></div>

    <!-- Grid -->
    

    <!-- Floating Blur -->
    <div class="absolute top-32 right-20 w-40 h-40 bg-cyan-400/20 rounded-full blur-3xl animate-float"></div>

    <div class="absolute bottom-32 left-20 w-52 h-52 bg-blue-500/20 rounded-full blur-3xl animate-float2"></div>

    <!-- Content -->
    <div class="relative z-20 text-center px-6 max-w-6xl mx-auto">

        <!-- Badge -->
        <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white/10 border border-white/20 backdrop-blur-2xl shadow-2xl mb-10">

            <div class="w-3 h-3 rounded-full bg-cyan-400 animate-ping"></div>

            <span class="uppercase tracking-[5px] text-sm md:text-base font-bold">
                SMP Negeri 1 Pirime
            </span>

        </div>

        <!-- Title -->
        <h1 class="hero-title text-5xl md:text-7xl lg:text-8xl font-black leading-tight mb-8">

            Galeri
            <span class="block bg-gradient-to-r from-cyan-300 via-blue-400 to-indigo-400 bg-clip-text text-transparent">

                Kegiatan Sekolah

            </span>

        </h1>

        <!-- Description -->
        <p class="max-w-3xl mx-auto text-lg md:text-2xl text-gray-200 leading-relaxed mb-12">

            Dokumentasi kegiatan belajar, prestasi siswa,
            olahraga, seminar, lomba, dan berbagai aktivitas
            terbaik SMP Negeri 1 Pirime.

        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-5">

            <a href="#gallery"
               class="group px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-600 hover:scale-105 transition-all duration-300 shadow-[0_0_50px_rgba(59,130,246,0.5)] font-bold text-lg">

                <i class="fas fa-images mr-2 group-hover:rotate-12 transition-all"></i>
                Jelajahi Galeri

            </a>

            <a href="/kontak"
               class="px-8 py-4 rounded-2xl border border-white/30 bg-white/10 backdrop-blur-xl hover:bg-white/20 transition-all duration-300 font-bold text-lg">

                <i class="fas fa-phone-alt mr-2"></i>
                Hubungi Kami

            </a>

        </div>

        <!-- Scroll -->
        <div class="absolute left-1/2 -translate-x-1/2 bottom-10 animate-bounce">

            <a href="#gallery"
               class="w-14 h-14 flex items-center justify-center rounded-full bg-white/10 border border-white/20 backdrop-blur-xl">

                <i class="fas fa-chevron-down text-xl text-white"></i>

            </a>

        </div>

    </div>

</section>

<!-- GALLERY -->
<section id="gallery" class="relative py-24 bg-slate-100 overflow-hidden">

    <!-- Background Glow -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-300/20 rounded-full blur-[120px]"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-400/20 rounded-full blur-[120px]"></div>

    <div class="relative max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-20">

            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-blue-100 text-blue-700 font-bold mb-6 shadow">

                <i class="fas fa-camera-retro"></i>
                Galeri Sekolah

            </div>

            <h2 class="text-4xl md:text-6xl font-black text-slate-800 mb-6">

                Momen Terbaik Sekolah

            </h2>

            <p class="text-lg text-gray-600 max-w-2xl mx-auto">

                Kumpulan dokumentasi kegiatan dan prestasi siswa
                SMP Negeri 1 Pirime.

            </p>

        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            @forelse($galleries as $index => $gallery)

            <div class="group relative rounded-[30px] overflow-hidden bg-white shadow-lg hover:shadow-[0_25px_80px_rgba(0,0,0,0.2)] transition-all duration-500 hover:-translate-y-4">

                <!-- Image -->
                <div class="relative overflow-hidden h-72">

                    <img src="{{ Storage::url($gallery->image) }}"
                         alt="{{ $gallery->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                    <!-- Shine -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-700 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full"></div>

                    <!-- Expand -->
                    <button onclick="openLightbox({{ $index }})"
                            class="absolute top-4 right-4 w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-xl text-white hover:bg-cyan-500 transition-all duration-300">

                        <i class="fas fa-expand"></i>

                    </button>

                    <!-- Category -->
                    <div class="absolute bottom-4 left-4">

                        <span class="px-4 py-2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-xs font-bold shadow-xl">

                            {{ $gallery->kategori ?? 'Galeri' }}

                        </span>

                    </div>

                </div>

                <!-- Content -->
                <div class="p-6">

                    <h3 class="text-2xl font-black text-slate-800 mb-3 line-clamp-1">

                        {{ $gallery->title }}

                    </h3>

                    <p class="text-slate-600 leading-relaxed mb-6 line-clamp-3">

                        {{ $gallery->description ?? 'Dokumentasi kegiatan sekolah SMPN 1 Pirime.' }}

                    </p>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-2 text-sm text-gray-500">

                            <i class="fas fa-calendar-alt text-cyan-500"></i>

                            {{ $gallery->created_at->format('d M Y') }}

                        </div>

                        <button onclick="openLightbox({{ $index }})"
                                class="px-5 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold hover:scale-105 transition-all duration-300">

                            Lihat

                        </button>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-span-full text-center py-32">

                <i class="fas fa-images text-8xl text-gray-300 mb-6"></i>

                <h3 class="text-4xl font-black text-gray-500 mb-4">

                    Belum Ada Galeri

                </h3>

                <p class="text-gray-400 text-lg">

                    Silakan tambahkan dokumentasi kegiatan sekolah.

                </p>

            </div>

            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-20 flex justify-center">

            {{ $galleries->links() }}

        </div>

    </div>

</section>

<!-- LIGHTBOX -->
<div id="lightbox-modal"
     class="fixed inset-0 bg-black/95 z-[9999] hidden items-center justify-center p-5">

    <!-- Close -->
    <button onclick="closeLightbox()"
            class="absolute top-6 right-6 w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-xl text-white text-2xl hover:bg-red-500 transition-all z-50">

        &times;

    </button>

    <!-- Prev -->
    <button onclick="prevImage()"
            class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-50 w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-xl text-white hover:bg-cyan-500 transition-all">

        <i class="fas fa-chevron-left"></i>

    </button>

    <!-- Next -->
    <button onclick="nextImage()"
            class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-50 w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-xl text-white hover:bg-cyan-500 transition-all">

        <i class="fas fa-chevron-right"></i>

    </button>

    <!-- Content -->
    <div class="max-w-7xl w-full grid lg:grid-cols-2 gap-10 items-center">

        <!-- Image -->
        <div>

            <img id="lightbox-img"
                 src=""
                 class="w-full max-h-[80vh] object-contain rounded-[30px] shadow-[0_20px_80px_rgba(0,0,0,0.8)]">

        </div>

        <!-- Info -->
        <div class="text-white">

            <div id="lightbox-counter"
                 class="inline-block px-5 py-2 rounded-full bg-cyan-500 text-sm font-bold mb-6">
            </div>

            <h2 id="lightbox-title"
                class="text-4xl md:text-5xl font-black mb-6 leading-tight">
            </h2>

            <p id="lightbox-desc"
               class="text-gray-300 text-lg leading-relaxed mb-8">
            </p>

            <div class="flex flex-wrap gap-4">

                <div id="lightbox-kategori"
                     class="px-5 py-2 rounded-full bg-indigo-600 font-semibold">
                </div>

                <div id="lightbox-date"
                     class="px-5 py-2 rounded-full bg-white/10 backdrop-blur-xl">
                </div>

            </div>

        </div>

    </div>

</div>

<style>

.line-clamp-1{
    overflow:hidden;
    display:-webkit-box;
    -webkit-line-clamp:1;
    -webkit-box-orient:vertical;
}

.line-clamp-3{
    overflow:hidden;
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
}

.hero-title{
    text-shadow:
    0 0 20px rgba(59,130,246,.5),
    0 0 40px rgba(59,130,246,.4),
    0 0 80px rgba(59,130,246,.3);
}

@keyframes bgZoom{
    0%{
        transform:scale(1.05);
    }
    100%{
        transform:scale(1.15);
    }
}

.animate-bg{
    animation:bgZoom 20s ease-in-out infinite alternate;
}

@keyframes float{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-30px);
    }
}

@keyframes float2{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(30px);
    }
}

.animate-float{
    animation:float 8s ease-in-out infinite;
}

.animate-float2{
    animation:float2 10s ease-in-out infinite;
}

html{
    scroll-behavior:smooth;
}

</style>

<script>

let currentIndex = 0;
let galleries = @json($galleries->items());

function openLightbox(index){

    currentIndex = index;

    showImage();

    const modal = document.getElementById('lightbox-modal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.style.overflow = 'hidden';
}

function closeLightbox(){

    const modal = document.getElementById('lightbox-modal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

    document.body.style.overflow = 'auto';
}

function showImage(){

    const gallery = galleries[currentIndex];

    document.getElementById('lightbox-img').src =
        '/storage/' + gallery.image;

    document.getElementById('lightbox-title').textContent =
        gallery.title;

    document.getElementById('lightbox-desc').innerHTML =
        gallery.description
        ? gallery.description.replace(/\n/g, '<br>')
        : 'Tidak ada deskripsi';

    document.getElementById('lightbox-kategori').textContent =
        gallery.kategori || 'Galeri';

    document.getElementById('lightbox-date').innerHTML =
        '<i class="fas fa-calendar-alt mr-2"></i>' +
        new Date(gallery.created_at).toLocaleDateString('id-ID');

    document.getElementById('lightbox-counter').textContent =
        (currentIndex + 1) + ' / ' + galleries.length;
}

function nextImage(){

    currentIndex = (currentIndex + 1) % galleries.length;

    showImage();
}

function prevImage(){

    currentIndex = (currentIndex - 1 + galleries.length) % galleries.length;

    showImage();
}

document.addEventListener('keydown', function(e){

    const modal = document.getElementById('lightbox-modal');

    if(modal.classList.contains('hidden')) return;

    if(e.key === 'Escape') closeLightbox();

    if(e.key === 'ArrowRight') nextImage();

    if(e.key === 'ArrowLeft') prevImage();
});

document.getElementById('lightbox-modal')
.addEventListener('click', function(e){

    if(e.target === this){
        closeLightbox();
    }
});

</script>

@endsection