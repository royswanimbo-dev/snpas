@extends('layouts.app')

@section('title', 'Pengaturan Profil Sekolah - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-12">
        <div>
            <h1 class="text-4xl font-bold text-gray-900">Pengaturan Profil Sekolah</h1>
            <p class="text-xl text-gray-600 mt-2">Kelola semua informasi sekolah dan status PPDB</p>
        </div>
        <button onclick="window.location.reload()" class="px-8 py-3 bg-gray-100 text-gray-800 rounded-2xl font-semibold hover:bg-gray-200 transition-all shadow-lg">
            <i class="fas fa-sync-alt mr-2"></i>Refresh Data
        </button>
    </div>

    <form id="profileForm" method="POST" action="{{ url('/admin/profil/update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Informasi Dasar -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                    <i class="fas fa-school text-blue-600 mr-4 text-3xl bg-blue-100 p-3 rounded-2xl shadow-lg"></i>
                    Informasi Dasar Sekolah
                </h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-4">Nama Lengkap Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sekolah" value="{{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }}" 
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all text-xl shadow-xl" required>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-semibold text-gray-800 mb-4">NPSN</label>
                            <input type="text" name="npsn" value="{{ $profile->npsn ?? '' }}" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all shadow-xl">
                        </div>
                        <div>
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Akreditasi <span class="text-red-500">*</span></label>
                            <select name="akreditasi" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all text-lg shadow-xl" required>
                                <option value="">Pilih Akreditasi</option>
                                <option value="Unggul" {{ ($profile->akreditasi ?? '') == 'Unggul' ? 'selected' : '' }}>Unggul</option>
                                <option value="A" {{ ($profile->akreditasi ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ ($profile->akreditasi ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ ($profile->akreditasi ?? '') == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-4">Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" value="{{ $profile->tahun_berdiri ?? '' }}" min="1900" max="{{ date('Y') }}" 
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition-all shadow-xl">
                    </div>

                    <div>
                        <label class="block text-lg font-semibold text-gray-800 mb-4">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="4" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all shadow-xl resize-vertical text-lg">{{ $profile->alamat ?? '' }}</textarea>
                    </div>

<div>
                        <label class="block text-lg font-semibold text-gray-800 mb-4">Nama Kepala Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="kepala_sekolah" value="{{ $profile->kepala_sekolah ?? '' }}" 
                               class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-pink-200 focus:border-pink-500 transition-all shadow-xl text-lg" required>
                    </div>
                    
                    <!-- Visi & Misi -->
                    <div class="mt-6">
                        <label class="block text-lg font-semibold text-gray-800 mb-4">Visi Sekolah</label>
                        <textarea name="visi" rows="3" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all shadow-xl resize-vertical text-lg" placeholder="Terwujudnya peserta didik yang unggul...">{{ $profile->visi ?? '' }}</textarea>
                    </div>
                    
                    <div class="mt-6">
                        <label class="block text-lg font-semibold text-gray-800 mb-4">Misi Sekolah (Satu poin per baris)</label>
                        <textarea name="misi" rows="5" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition-all shadow-xl resize-vertical text-lg" placeholder="Menyediakan pembelajaran berkualitas&#10;Menanamkan karakter disiplin&#10;Mengembangkan prestasi akademik">@if($profile->misi)
@php
$misiList = is_array($profile->misi) ? $profile->misi : json_decode($profile->misi, true);
@endphp
@if(is_array($misiList))
{{ implode("\n", $misiList) }}
@else
{{ $profile->misi }}
@endif
@endif</textarea>
                        <p class="text-sm text-gray-500 mt-2">Tulis satu poin tiap baris</p>
                    </div>
                    
                    <!-- Statistik -->
                    <div class="grid md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Total Siswa</label>
                            <input type="number" name="total_siswa" value="{{ $profile->total_siswa ?? 0 }}" min="0" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-all shadow-xl">
                        </div>
                        <div>
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Total Guru</label>
                            <input type="number" name="total_guru" value="{{ $profile->total_guru ?? 0 }}" min="0" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all shadow-xl">
                        </div>
                        <div>
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Total Prestasi</label>
                            <input type="number" name="total_prestasi" value="{{ $profile->total_prestasi ?? 0 }}" min="0" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition-all shadow-xl">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status PPDB Toggle & Foto Kepsek -->
            <div class="space-y-8">
                <!-- PPDB Status Toggle -->
                <div class="bg-gradient-to-r from-emerald-50 to-blue-50 rounded-3xl p-10 shadow-2xl border border-emerald-200">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                        <i class="fas fa-toggle-on text-emerald-600 mr-4 text-3xl bg-emerald-100 p-3 rounded-2xl shadow-lg"></i>
                        Status Pendaftaran PPDB
                    </h2>
                    
                    <div class="flex flex-col lg:flex-row gap-8 items-start lg:items-center">
                        <div class="flex-1">
                            <p class="text-xl text-gray-700 leading-relaxed mb-6">
                                Kontrol status pendaftaran secara global. 
                                <strong>Siswa tidak bisa mendaftar saat ditutup.</strong>
                            </p>
                            <div class="flex items-center space-x-6">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="ppdb_open" value="1" {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-20 h-12 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-focus:ring-ring peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-3xl after:h-10 after:w-10 after:transition-all peer-checked:bg-emerald-600 shadow-xl"></div>
                                </label>
                                <div class="min-w-0">
                                    <span class="text-3xl font-bold block {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? 'text-emerald-600' : 'text-red-600' }}">
                                        {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? '✅ Dibuka' : '❌ Ditutup' }}
                                    </span>
                                    <p class="text-lg font-medium {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? 'text-emerald-700' : 'text-red-700' }}">
                                        {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? 'Siswa dapat mendaftar online sekarang' : 'Semua tombol daftar diblokir otomatis' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Foto Kepsek -->
                <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                        <i class="fas fa-user-tie text-purple-600 mr-4 text-3xl bg-purple-100 p-3 rounded-2xl shadow-lg"></i>
                        Foto & Sambutan Kepala Sekolah
                    </h2>
                    
<div class="space-y-6">
                        <div class="flex items-center justify-center">
                            <div class="w-80 h-80 rounded-3xl overflow-hidden shadow-2xl border-8 border-white relative group hover:shadow-3xl transition-all">
                                @if($profile->foto_kepsek)
                                    <img src="{{ asset('storage/profiles/' . $profile->foto_kepsek) }}" alt="Kepala Sekolah" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <i class="fas fa-user text-6xl text-gray-500"></i>
                                    </div>
                                @endif
                                <label class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                                    <span class="text-white font-bold text-xl px-6 py-3 bg-blue-600 rounded-2xl hover:bg-blue-700 transition-all">
                                        <i class="fas fa-camera mr-2"></i>Ganti Foto
                                    </span>
                                    <input type="file" name="foto_kepsek" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-lg font-semibold text-gray-800 mb-4">Sambutan Kepala Sekolah</label>
                            <textarea name="sambutan" rows="8" class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition-all shadow-xl resize-vertical text-lg" placeholder="Selamat datang di SMPN 1 Pirime...">{{ $profile->sambutan ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Preview -->
                <div class="bg-gradient-to-br from-emerald-50 to-blue-50 rounded-3xl p-10 shadow-2xl border border-emerald-100 col-span-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-desktop mr-3 text-emerald-600"></i>Live Preview Website
                    </h3>
                    <div class="bg-white rounded-2xl p-8 shadow-xl border-4 border-gray-100 max-h-96 overflow-y-auto">
                        <div class="text-center mb-8">
                            <div class="inline-block px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl font-bold text-lg shadow-lg mx-auto">
                                <i class="fas fa-award mr-2"></i>{{ $profile->akreditasi ?? 'Unggul' }}
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">{{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }}</h2>
                        <div class="mb-8">
                            <p class="text-2xl text-gray-700 text-center font-medium mb-4">Alamat:</p>
                            <p class="text-lg text-gray-600 leading-relaxed px-8 text-center">{{ $profile->alamat ?? '' }}</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-6 items-center justify-center">
                            @if($profile->foto_kepsek)
                                <img src="{{ asset('storage/profiles/' . $profile->foto_kepsek) }}" alt="Kepala Sekolah" class="w-32 h-32 rounded-full shadow-2xl object-cover mx-auto">
                            @else
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center mx-auto shadow-2xl">
                                    <i class="fas fa-user text-3xl text-gray-500"></i>
                                </div>
                            @endif
                            <div class="text-center">
                                <div class="inline-flex items-center bg-gradient-to-r from-green-400 to-emerald-500 text-white px-6 py-3 rounded-2xl font-bold shadow-lg">
                                    <i class="fas fa-user-tie mr-2"></i>{{ $profile->kepala_sekolah ?? 'Nama Kepala Sekolah' }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl">
                            <p class="text-xl italic text-gray-800 text-center leading-relaxed">"{{ Str::limit($profile->sambutan ?? 'Sambutan kepala sekolah akan muncul di sini...', 200) }}"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-12 border-t border-gray-200">
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="px-10 py-4 border-2 border-gray-300 text-gray-700 rounded-2xl font-bold hover:bg-gray-50 hover:border-gray-400 transition-all shadow-lg">
                    <i class="fas fa-times mr-3"></i>Batal
                </a>
                <button type="submit" class="px-12 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-bold shadow-2xl hover:shadow-3xl hover:scale-[1.02] hover:from-blue-700 hover:to-indigo-700 transition-all duration-300">
                    <i class="fas fa-save mr-3"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview update
    const formInputs = document.querySelectorAll('#profileForm input, #profileForm textarea, #profileForm select');
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            const nama = document.querySelector('[name="nama_sekolah"]').value || 'SMPN 1 Pirime';
            const alamat = document.querySelector('[name="alamat"]').value;
            const kepsek = document.querySelector('[name="kepala_sekolah"]').value;
            const akreditasi = document.querySelector('[name="akreditasi"]').value || 'Unggul';
            
            // Update preview
            const previewNama = document.querySelector('.preview-nama');
            const previewAlamat = document.querySelector('.preview-alamat');
            const previewKepsek = document.querySelector('.preview-kepsek');
            const previewAkreditasi = document.querySelector('.preview-akreditasi');
            
            if (previewNama) previewNama.textContent = nama;
            if (previewAlamat) previewAlamat.textContent = alamat;
            if (previewKepsek) previewKepsek.textContent = kepsek;
            if (previewAkreditasi) previewAkreditasi.textContent = akreditasi;
        });
    });

    // Form validation
    const form = document.getElementById('profileForm');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'ring-4', 'ring-red-200');
                isValid = false;
            } else {
                field.classList.remove('border-red-500', 'ring-4', 'ring-red-200');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon isi semua field yang wajib (*)');
        }
    });
});
</script>
@endpush
@endsection

