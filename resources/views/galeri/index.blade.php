@extends('layouts.public')

@section('title', 'Galeri Foto - SMPN 1 Pirime')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;
@endphp
<!-- Hero Section -->
<section class="pt-28 pb-20 relative bg-gradient-to-br from-gray-900 via-blue-900/20 to-gray-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center bg-no-repeat"></div>
    <div class="relative z-10 py-24 px-4 max-w-7xl mx-auto text-center">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white via-blue-200 to-purple-200 bg-clip-text text-transparent drop-shadow-2xl">
            <i class="fas fa-images mr-4"></i>Galeri
        </h1>
        <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto leading-relaxed">
            Kenang-kenangan kegiatan dan prestasi siswa SMPN 1 Pirime
        </p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-20 bg-white/50 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Kumpulan Foto Terbaik</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Lihat momen-momen indah dari aktivitas sekolah kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12" id="gallery-grid">
@forelse($galleries as $index => $gallery)
            <div class="group relative overflow-hidden rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 bg-white/80 backdrop-blur-sm hover:bg-white">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ Storage::url($gallery->image) }}" 
                         alt="{{ $gallery->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
<h3 class="font-black text-2xl text-gray-900 mb-4 drop-shadow-md line-clamp-1 hover:text-blue-700 transition-all duration-300">{{ $gallery->title }}</h3>
                    <p class="font-medium text-lg text-gray-700 leading-relaxed line-clamp-3 mb-6 shadow-sm p-3 bg-white/80 rounded-2xl">{{ $gallery->description ?? 'Deskripsi foto kegiatan sekolah.' }}</p>
                    <div class="flex flex-col sm:flex-row gap-2 items-center justify-between">
                        <div class="flex items-center text-xs text-gray-500 order-2 sm:order-1 flex-shrink-0">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $gallery->created_at->format('d M Y') }}
                        </div>
                        <button onclick="openLightbox({{ $index }})" 
                                class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white text-sm font-semibold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center order-1 sm:order-2 whitespace-nowrap group/btn">
                            <i class="fas fa-eye mr-2 group-hover/btn:animate-pulse"></i>
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>
                {{-- Keep expand icon for hover --}}
                <button onclick="openLightbox({{ $index }})" 
                        class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 w-12 h-12 bg-white/90 hover:bg-white rounded-2xl shadow-2xl hover:shadow-3xl flex items-center justify-center text-blue-600 hover:scale-110 z-10">
                    <i class="fas fa-expand-arrows-alt text-xl"></i>
                </button>
            </div>
            @empty
            <div class="col-span-full text-center py-32">
                <i class="fas fa-images text-8xl text-gray-300 mb-8"></i>
                <h3 class="text-3xl font-bold text-gray-500 mb-4">Belum ada foto galeri</h3>
                <p class="text-xl text-gray-400">Silakan hubungi admin untuk menambahkan foto kegiatan</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $galleries->links() }}
        </div>
    </div>
</section>

<!-- Modern Center Text Lightbox -->
<div id="lightbox-modal" class="fixed inset-0 bg-gradient-to-br from-black via-gray-900/90 to-black z-[9999] hidden flex items-center justify-center p-6">
    <button onclick="closeLightbox()" class="absolute top-8 right-8 w-16 h-16 bg-white/20 hover:bg-white/40 backdrop-blur-xl rounded-3xl flex items-center justify-center text-white text-2xl font-bold shadow-2xl hover:scale-110 transition-all z-20 border border-white/30">
        &times;
    </button>
    
    <!-- Image -->
    <div class="relative flex-1 max-w-6xl max-h-[95vh] flex items-center justify-center">
    <img id="lightbox-img" src="" alt="" class="max-h-[90vh] max-w-[90vw] object-contain rounded-4xl shadow-4xl cursor-zoom-in hover:scale-105 transition-all duration-500 mx-auto">
    </div>
    
    <!-- Center Text Overlay -->
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-8 max-w-4xl mx-auto z-10 pointer-events-none">
        <div class="bg-black/60 backdrop-blur-2xl rounded-4xl p-12 max-h-[80vh] overflow-y-auto scrollbar-thin w-full max-w-3xl mx-8 shadow-4xl border border-white/20">
            <div id="lightbox-counter" class="text-2xl font-black text-blue-400 mb-8 bg-white/20 px-6 py-3 rounded-3xl inline-block border border-blue-400/50 shadow-2xl"></div>
            <h2 id="lightbox-title" class="text-4xl md:text-5xl lg:text-6xl font-black mb-8 bg-gradient-to-r from-white to-gray-200 bg-clip-text text-transparent drop-shadow-2xl leading-tight"></h2>
            <div id="lightbox-desc" class="text-xl md:text-2xl lg:text-3xl font-medium text-gray-100 leading-10 prose prose-invert prose-headings:text-4xl prose-p:text-2xl max-h-[50vh] overflow-y-auto mx-auto scrollbar-thin scrollbar-thumb-white/50 hover:scrollbar-thumb-white scrollbar-track-black/50 p-8 prose-strong:text-white mb-12"></div>
            <div class="flex items-center gap-8 text-lg opacity-90">
                <span id="lightbox-kategori" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold rounded-3xl shadow-xl"></span>
                <span id="lightbox-date" class="flex items-center gap-3 px-6 py-3 bg-white/20 backdrop-blur-xl rounded-3xl font-semibold">
                    <i class="fas fa-calendar-alt text-xl"></i>
                    <span></span>
                </span>
            </div>
            <button onclick="shareImage()" class="mt-12 px-12 py-6 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xl font-bold rounded-4xl shadow-2xl hover:shadow-4xl hover:scale-105 transition-all duration-300 pointer-events-auto backdrop-blur-xl border border-white/30">
                <i class="fas fa-share-alt mr-3"></i>Bagikan Kisah Ini
            </button>
        </div>
    </div>
    
    <button onclick="prevImage()" class="absolute left-12 top-1/2 -translate-y-1/2 w-20 h-20 md:w-24 md:h-24 bg-white/30 hover:bg-white/50 backdrop-blur-xl rounded-4xl flex items-center justify-center text-white text-3xl font-bold shadow-2xl hover:scale-125 transition-all duration-300 z-20 border border-white/40 hover:border-white/60">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button onclick="nextImage()" class="absolute right-12 top-1/2 -translate-y-1/2 w-20 h-20 md:w-24 md:h-24 bg-white/30 hover:bg-white/50 backdrop-blur-xl rounded-4xl flex items-center justify-center text-white text-3xl font-bold shadow-2xl hover:scale-125 transition-all duration-300 z-20 border border-white/40 hover:border-white/60">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
let currentIndex = 0;
let galleries = @json($galleries->items());

function openLightbox(index) {
    currentIndex = index;
    showImage();
    document.getElementById('lightbox-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function showImage() {
    const gallery = galleries[currentIndex];
    const img = document.getElementById('lightbox-img');
    
    // Update image with correct path
    img.onload = () => {
        img.style.transition = 'opacity 0.3s ease';
        img.style.opacity = '1';
    };
    
    img.onerror = () => {
        img.src = '/images/bg/smp.png';
    };
    
    img.src = '/storage/gallery/' + gallery.image;
    
    // Update overlay content
    document.getElementById('lightbox-title').textContent = gallery.title;
    document.getElementById('lightbox-desc').innerHTML = gallery.description ? gallery.description.replace(/\n/g, '<br>') : 'Tidak ada deskripsi.';
    document.getElementById('lightbox-kategori').textContent = gallery.kategori || 'Lainnya';
    document.getElementById('lightbox-date').innerHTML = '<i class="fas fa-calendar-alt mr-2"></i>' + new Date(gallery.created_at).toLocaleDateString('id-ID');
    document.getElementById('lightbox-counter').textContent = (currentIndex + 1) + ' / ' + galleries.length;
}
    
    // Update full description (no clamp)
    document.getElementById('lightbox-desc').innerHTML = gallery.description ? gallery.description.replace(/\n/g, '<br>') : 'Tidak ada deskripsi.';
}

function shareImage() {
    if (navigator.share) {
        navigator.share({
            title: document.getElementById('lightbox-title').textContent,
            text: document.getElementById('lightbox-desc').textContent,
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        alert('Link disalin ke clipboard!');
    }
}

function nextImage() {
    currentIndex = (currentIndex + 1) % galleries.length;
    showImage();
}

function prevImage() {
    currentIndex = (currentIndex - 1 + galleries.length) % galleries.length;
    showImage();
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('lightbox-modal').classList.contains('hidden')) return;
    
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
});

// Mobile swipe support
let startX = 0;
let currentTranslate = 0;
let isDragging = false;

const modal = document.getElementById('lightbox-modal');
const imgContainer = modal.querySelector('div.relative');

modal.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
    isDragging = true;
    imgContainer.style.transition = 'none';
});

modal.addEventListener('touchmove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const currentX = e.touches[0].clientX;
    currentTranslate = currentX - startX;
});

modal.addEventListener('touchend', (e) => {
    if (!isDragging) return;
    isDragging = false;
    
    const threshold = 50;
    if (currentTranslate > threshold) {
        prevImage();
    } else if (currentTranslate < -threshold) {
        nextImage();
    }
    
    imgContainer.style.transition = 'transform 0.3s ease';
    imgContainer.style.transform = 'translateX(0)';
});

// Close on outside click
document.getElementById('lightbox-modal').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});

// Prevent zoom on double tap
let lastTap = 0;
modal.addEventListener('touchend', (e) => {
    const now = new Date().getTime();
    if (now - lastTap < 300) {
        e.preventDefault();
    }
    lastTap = now;
});
</script>

@endsection

