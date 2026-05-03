@extends('layouts.public')

@section('title', 'APLIKASI PPDB SMPN 1 PIRIME - Pendaftaran Online')

@section('content')

<!-- Hero Section -->
<section class="relative py-20 sm:py-28 lg:py-32 overflow-hidden" ">
    <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center bg-no-repeat"></div>
    <div class="relative z-10 py-20 px-4 max-w-6xl mx-auto text-center sm:px-6">
        <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" 
             alt="Logo APLIKASI PPDB SMPN 1 PIRIME"
             class="mx-auto h-24 w-24 md:h-32 md:w-32 lg:h-40 lg:w-40 rounded-3xl shadow-2xl mb-6 animate-float">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-4 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent drop-shadow-2xl">
            APLIKASI PPDB
        </h1>
      <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl text-blue-500 max-w-2xl mx-auto leading-relaxed mb-8">
    Penerimaan Peserta Didik Baru. <span class="text-yellow-400 font-bold">{{ date('Y') }}/{{ date('Y')+1 }}</span><br>
            <span class="text-white/80 text-sm block mt-2">SMPN 1 PIRIME - Berbasis Web Modern</span>
        </p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center max-w-2xl mx-auto">
            <a href="{{ route('register.form') }}" 
               class="bg-white text-blue-600 px-8 py-4 sm:px-12 sm:py-6 rounded-3xl font-bold text-lg sm:text-xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 flex items-center">
                <i class="fas fa-user-plus mr-3 text-2xl"></i>Daftar Sekarang
            </a>
            <a href="{{ route('login.form') }}" 
               class="border-4 border-white text-white px-8 py-4 sm:px-12 sm:py-6 rounded-3xl font-bold text-lg sm:text-xl hover:bg-white hover:text-blue-600 transition-all duration-300 flex items-center">
                <i class="fas fa-sign-in-alt mr-3 text-xl"></i>Login Pendaftar
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo APLIKASI PPDB SMPN 1 PIRIME" class="mx-auto h-20 w-20 rounded-2xl shadow-xl mb-8">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Siap Daftar PPDB SMPN 1 PIRIME?</h2>
        <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">Aplikasi PPDB berbasis web modern untuk pendaftaran siswa baru yang mudah, cepat, dan aman.</p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ route('register.form') }}" 
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-12 py-5 rounded-2xl font-bold text-xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-300 flex items-center">
                <i class="fas fa-rocket mr-3"></i>Mulai Pendaftaran
            </a>
            <a href="https://wa.me/6282120445529" target="_blank" 
               class="border-4 border-blue-600 text-blue-600 px-12 py-5 rounded-2xl font-bold text-xl hover:bg-blue-600 hover:text-white transition-all duration-300 flex items-center justify-center">
                <i class="fab fa-whatsapp mr-3 text-2xl"></i>Hubungi WA
            </a>
        </div>
    </div>
</section>

<!-- Floating WA Button -->
<a href="https://wa.me/6282120445529?text=Halo%20PPDB%20SMPN%201%20Pirime%2C%20saya%20ingin%20bertanya%20tentang%20pendaftaran" 
   class="fixed bottom-6 right-6 w-16 h-16 bg-green-500 text-white rounded-full shadow-2xl hover:shadow-3xl hover:scale-110 transition-all duration-300 z-40 flex items-center justify-center text-xl" 
   target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Modal for Pengumuman -->
<div id="pengumumanModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-2xl font-bold text-gray-900" id="modalTitle"></h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold">&times;</button>
            </div>
            <div id="modalContent" class="prose prose-lg max-w-none mb-8 leading-relaxed text-gray-800"></div>
            <div class="flex justify-end">
                <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-times mr-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showPengumuman(id) {
    fetch(`/api/pengumuman/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = data.judul;
            document.getElementById('modalContent').innerHTML = data.isi.replace(/\n/g, '<br>');
            document.getElementById('pengumumanModal').classList.remove('hidden');
        });
}
function closeModal() {
    document.getElementById('pengumumanModal').classList.add('hidden');
}
</script>

@endsection

