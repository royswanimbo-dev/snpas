@extends('layouts.public')

@section('title', 'Galeri Foto - SMPN 1 Pirime')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;
@endphp
<!-- Hero Parallax -->
<section class="relative h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-gray-900 via-blue-900 to-black">
  <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center bg-fixed opacity-40"></div>
  <div class="relative z-10 text-center text-white px-6 max-w-4xl mx-auto">
    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-8 bg-gradient-to-r from-white via-cyan-200 to-blue-300 bg-clip-text text-transparent drop-shadow-2xl animate-fade-in-up">
      <i class="fas fa-images mr-6"></i>GALERI
    </h1>
    <p class="text-xl md:text-2xl lg:text-3xl opacity-90 leading-relaxed animate-fade-in-up animation-delay-200 max-w-2xl mx-auto">
      Momen Keren Kegiatan & Prestasi Siswa SMPN 1 Pirime
    </p>
  </div>
</section>

<!-- Filters & Masonry -->
<section class="py-24 bg-gradient-to-b from-gray-50 to-white">
  <div class="max-w-7xl mx-auto px-6">
    <!-- Filters -->
    <div class="text-center mb-20">
      <h2 class="text-5xl font-black text-gray-900 mb-6">Jelajahi Galeri</h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12">Filter berdasarkan kategori kegiatan sekolah</p>
      <div class="flex flex-wrap gap-4 justify-center max-w-4xl mx-auto">
        <button data-filter="all" class="filter-btn px-8 py-4 bg-blue-600 text-white font-bold rounded-3xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 text-lg">
          Semua
        </button>
        <button data-filter="Kegiatan" class="filter-btn px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
          Kegiatan
        </button>
        <button data-filter="Prestasi" class="filter-btn px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
          Prestasi
        </button>
        <button data-filter="Fasilitas" class="filter-btn px-8 py-4 bg-gradient-to-r from-purple-500 to-violet-600 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
          Fasilitas
        </button>
        <button data-filter="Guru" class="filter-btn px-8 py-4 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
          Guru
        </button>
        <button data-filter="Siswa" class="filter-btn px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-600 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-lg">
          Siswa
        </button>
      </div>
    </div>

    <!-- Masonry Grid Desktop -->
    <div class="columns-1 md:columns-2 lg:columns-3 xl:columns-4 gap-6 mb-16 hidden lg:block" id="masonry-desktop">
      @forelse($galleries as $gallery)
        <div class="break-inside-avoid mb-6 group cursor-pointer" data-kategori="{{ $gallery->kategori ?? 'Lainnya' }}" onclick="openModernLightbox({{ $loop->index }})">
          <div class="bg-white/90 backdrop-blur-xl rounded-4xl shadow-2xl hover:shadow-4xl overflow-hidden transition-all duration-500 hover:-translate-y-4 hover:scale-[1.02]">
            <div class="relative h-64 lg:h-80 overflow-hidden">
              <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" 
                   class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:brightness-110">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
              <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                <span class="inline-block px-4 py-2 bg-white/90 text-xs font-bold text-gray-800 rounded-full shadow-lg">{{ $gallery->kategori ?? 'Lainnya' }}</span>
              </div>
            </div>
            <div class="p-8">
              <h3 class="font-black text-2xl text-gray-900 mb-3 line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $gallery->title }}</h3>
              <p class="text-gray-600 line-clamp-2 leading-relaxed mb-4">{{ $gallery->description }}</p>
              <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500 flex items-center">
                  <i class="fas fa-calendar mr-2"></i>{{ $gallery->created_at->format('d M Y') }}
                </span>
                <span class="text-blue-600 font-bold group-hover:text-blue-700 transition-colors">
                  <i class="fas fa-eye mr-1"></i>Lihat Detail
                </span>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-32 col-start-1 row-start-1 row-span-2">
          <i class="fas fa-images text-9xl text-gray-200 mb-8 animate-bounce"></i>
          <h3 class="text-4xl font-black text-gray-500 mb-4">Belum ada galeri</h3>
          <p class="text-xl text-gray-400 mb-8">Foto kegiatan akan tampil di sini</p>
        </div>
      @endforelse
    </div>

    <!-- Mobile Carousel -->
    <div class="lg:hidden overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-8 space-x-6" id="mobile-carousel">
      @forelse($galleries as $gallery)
        <div class="snap-center w-80 flex-shrink-0" data-kategori="{{ $gallery->kategori ?? 'Lainnya' }}" onclick="openModernLightbox({{ $loop->index }})">
          <div class="bg-white/95 backdrop-blur-xl rounded-4xl shadow-2xl hover:shadow-3xl transition-all duration-400 cursor-pointer">
            <div class="relative h-64 overflow-hidden rounded-t-4xl">
              <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
              <span class="absolute top-4 left-4 px-3 py-1 bg-black/80 text-white text-xs font-bold rounded-full">{{ $gallery->kategori ?? 'Lainnya' }}</span>
            </div>
            <div class="p-6">
              <h3 class="font-black text-xl text-gray-900 mb-2 line-clamp-1 hover:text-blue-600 transition-colors">{{ $gallery->title }}</h3>
              <p class="text-gray-600 text-sm line-clamp-2">{{ $gallery->description }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="snap-center w-full text-center py-32">
          <i class="fas fa-images text-9xl text-gray-200 mb-8 animate-pulse"></i>
          <p class="text-2xl text-gray-400">Belum ada foto</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Modern Fullscreen Lightbox -->
<div id="modern-lightbox" class="fixed inset-0 bg-black z-[9999] hidden items-center justify-center p-4 overflow-hidden">
  <button onclick="closeModernLightbox()" class="absolute top-8 right-8 text-white text-4xl hover:scale-110 z-20 transition-transform">&times;</button>
  <div class="w-full h-full relative flex items-center justify-center">
    <button onclick="prevModern()" class="absolute left-8 w-20 h-20 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white text-3xl hover:scale-110 transition-all z-20 backdrop-blur-sm">
      <i class="fas fa-chevron-left"></i>
    </button>
    <img id="modern-lightbox-img" src="" alt="" class="max-w-full max-h-full object-contain cursor-zoom-in hover:scale-110 transition-transform duration-300">
    <button onclick="nextModern()" class="absolute right-8 w-20 h-20 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white text-3xl hover:scale-110 transition-all z-20 backdrop-blur-sm">
      <i class="fas fa-chevron-right"></i>
    </button>
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-md px-8 py-6 rounded-4xl text-white text-center max-w-2xl mx-auto shadow-2xl opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 pointer-events-none">
      <h3 id="modern-title" class="text-3xl font-black mb-4 drop-shadow-xl"></h3>
      <div id="modern-desc" class="text-lg leading-relaxed prose prose-invert max-h-32 overflow-y-auto mb-6 scrollbar-thin"></div>
      <div class="flex items-center justify-center gap-6 text-sm opacity-90">
        <span id="modern-kategori" class="px-4 py-2 bg-white/20 rounded-full font-bold"></span>
        <span id="modern-date" class="flex items-center gap-2">
          <i class="fas fa-calendar"></i><span></span>
        </span>
      </div>
      <button onclick="shareModern()" class="mt-6 px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold rounded-3xl shadow-xl hover:shadow-2xl transition-all">
        <i class="fas fa-share mr-2"></i>Bagikan
      </button>
    </div>
  </div>
</div>

<style>
/* Custom Scrollbar */
.scrollbar-thin::-webkit-scrollbar {
  width: 6px;
}
.scrollbar-thin::-webkit-scrollbar-track {
  background: transparent;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
  background: rgba(255,255,255,0.3);
  border-radius: 3px;
}
.scrollbar-thin::-webkit-scrollbar-thumb:hover {
  background: rgba(255,255,255,0.5);
}

/* Mobile Carousel Hide */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

/* Animations */
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out forwards;
}
.animation-delay-200 {
  animation-delay: 0.2s;
}
</style>

<script>
let modernGalleries = @json($galleries->items());
let currentModernIndex = 0;
let activeFilter = 'all';

// Filter Logic
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('ring-4', 'ring-white/50', 'shadow-2xl'));
    btn.classList.add('ring-4', 'ring-white/50', 'shadow-2xl');
    activeFilter = btn.dataset.filter;
    filterGalleries();
  });
});

function filterGalleries() {
  const items = document.querySelectorAll('[data-kategori]');
  items.forEach(item => {
    if (activeFilter === 'all' || item.dataset.kategori === activeFilter) {
      item.style.display = 'block';
      item.classList.add('animate-fade-in-up');
    } else {
      item.style.display = 'none';
    }
  });
}

// Modern Lightbox
function openModernLightbox(index) {
  currentModernIndex = index;
  showModernImage();
  document.getElementById('modern-lightbox').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeModernLightbox() {
  document.getElementById('modern-lightbox').classList.add('hidden');
  document.body.style.overflow = 'auto';
}

function showModernImage() {
  const gallery = modernGalleries[currentModernIndex];
  const img = document.getElementById('modern-lightbox-img');
  const title = document.getElementById('modern-title');
  const desc = document.getElementById('modern-desc');
  const kategori = document.getElementById('modern-kategori');
  const date = document.getElementById('modern-date span');
  
  img.src = '{{ asset("storage") }}/' + gallery.image;
  title.textContent = gallery.title;
  desc.innerHTML = gallery.description ? gallery.description.replace(/\n/g, '<br>') : 'Tidak ada deskripsi.';
  kategori.textContent = gallery.kategori || 'Lainnya';
  date.textContent = new Date(gallery.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

function nextModern() {
  currentModernIndex = (currentModernIndex + 1) % modernGalleries.length;
  showModernImage();
}

function prevModern() {
  currentModernIndex = (currentModernIndex - 1 + modernGalleries.length) % modernGalleries.length;
  showModernImage();
}

function shareModern() {
  navigator.share({
    title: document.getElementById('modern-title').textContent,
    url: window.location.href
  }).catch(() => navigator.clipboard.writeText(window.location.href));
}

// Close on escape/outside
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') closeModernLightbox();
});
document.getElementById('modern-lightbox').addEventListener('click', e => {
  if (e.target === e.currentTarget) closeModernLightbox();
});

// Init
filterGalleries();
</script>

@endsection

