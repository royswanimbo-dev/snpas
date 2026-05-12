@extends('layouts.app')

@section('title', 'Pengaturan Profil Sekolah - Admin')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-12">

        <div>
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight">
                Pengaturan Profil Sekolah
            </h1>

            <p class="text-lg md:text-xl text-gray-600 mt-3">
                Kelola semua informasi sekolah, status PPDB, dan tampilan website sekolah.
            </p>
        </div>

        <button onclick="window.location.reload()"
            class="group px-8 py-4 bg-gradient-to-r from-slate-800 to-slate-900 text-white rounded-2xl font-bold shadow-2xl hover:scale-105 transition-all duration-300">

            <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-all duration-700"></i>
            Refresh Data

        </button>

    </div>

    <!-- FORM -->
    <form id="profileForm"
        method="POST"
        action="{{ url('/admin/profil/update') }}"
        enctype="multipart/form-data"
        class="space-y-10">

        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- LEFT -->
            <div class="space-y-10">

                <!-- INFORMASI SEKOLAH -->
                <div class="bg-white rounded-[35px] shadow-[0_15px_60px_rgba(0,0,0,0.08)] border border-gray-100 p-10">

                    <div class="flex items-center gap-5 mb-10">

                        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-700 flex items-center justify-center shadow-2xl">

                            <i class="fas fa-school text-white text-3xl"></i>

                        </div>

                        <div>
                            <h2 class="text-3xl font-black text-gray-900">
                                Informasi Sekolah
                            </h2>

                            <p class="text-gray-500 text-lg">
                                Kelola identitas resmi sekolah
                            </p>
                        </div>

                    </div>

                    <div class="space-y-7">

                        <!-- Nama -->
                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">
                                Nama Sekolah
                            </label>

                            <input type="text"
                                name="nama_sekolah"
                                value="{{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }}"
                                required
                                class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all text-lg font-semibold shadow-xl">
                        </div>

                        <!-- Grid -->
                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-lg font-bold text-gray-800 mb-3">
                                    NPSN
                                </label>

                                <input type="text"
                                    name="npsn"
                                    value="{{ $profile->npsn ?? '' }}"
                                    class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all shadow-xl">
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-800 mb-3">
                                    Akreditasi
                                </label>

                                <select name="akreditasi"
                                    class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 outline-none transition-all shadow-xl">

                                    <option value="Unggul" {{ ($profile->akreditasi ?? '') == 'Unggul' ? 'selected' : '' }}>
                                        Unggul
                                    </option>

                                    <option value="A" {{ ($profile->akreditasi ?? '') == 'A' ? 'selected' : '' }}>
                                        A
                                    </option>

                                    <option value="B" {{ ($profile->akreditasi ?? '') == 'B' ? 'selected' : '' }}>
                                        B
                                    </option>

                                    <option value="C" {{ ($profile->akreditasi ?? '') == 'C' ? 'selected' : '' }}>
                                        C
                                    </option>

                                </select>
                            </div>

                        </div>

                        <!-- Tahun -->
                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">
                                Tahun Berdiri
                            </label>

                            <input type="number"
                                name="tahun_berdiri"
                                value="{{ $profile->tahun_berdiri ?? '' }}"
                                class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all shadow-xl">
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">
                                Alamat Sekolah
                            </label>

                            <textarea name="alamat"
                                rows="4"
                                class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all shadow-xl resize-none">{{ $profile->alamat ?? '' }}</textarea>
                        </div>

                        <!-- Kepala Sekolah -->
                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">
                                Nama Kepala Sekolah
                            </label>

                            <input type="text"
                                name="kepala_sekolah"
                                value="{{ $profile->kepala_sekolah ?? '' }}"
                                class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-pink-500 focus:ring-4 focus:ring-pink-100 outline-none transition-all shadow-xl">
                        </div>

                    </div>

                </div>

                <!-- VISI MISI -->
                <div class="bg-white rounded-[35px] shadow-[0_15px_60px_rgba(0,0,0,0.08)] border border-gray-100 p-10">

                    <h2 class="text-3xl font-black text-gray-900 mb-8">
                        Visi & Misi
                    </h2>

                    <div class="space-y-7">

                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">
                                Visi Sekolah
                            </label>

                            <textarea name="visi"
                                rows="4"
                                class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 outline-none transition-all shadow-xl resize-none">{{ $profile->visi ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">
                                Misi Sekolah
                            </label>

                            <textarea name="misi"
                                rows="6"
                                class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all shadow-xl resize-none">@if($profile->misi)
@php
$misiList = is_array($profile->misi) ? $profile->misi : json_decode($profile->misi, true);
@endphp
@if(is_array($misiList))
{{ implode("\n", $misiList) }}
@else
{{ $profile->misi }}
@endif
@endif</textarea>

                            <p class="text-gray-500 mt-2">
                                Satu poin setiap baris
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-10">

                <!-- STATUS PPDB -->
                <div class="relative overflow-hidden rounded-[35px] p-10 shadow-[0_20px_70px_rgba(16,185,129,0.2)] bg-gradient-to-br from-emerald-500 via-green-500 to-teal-600 text-white">

                    <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

                    <div class="relative z-10">

                        <div class="flex items-center gap-5 mb-8">

                            <div class="w-20 h-20 rounded-3xl bg-white/20 backdrop-blur-xl flex items-center justify-center">

                                <i class="fas fa-toggle-on text-4xl"></i>

                            </div>

                            <div>

                                <h2 class="text-3xl font-black">
                                    Status PPDB
                                </h2>

                                <p class="text-emerald-100 text-lg">
                                    Kontrol pendaftaran online
                                </p>

                            </div>

                        </div>

                        <div class="flex items-center gap-6">

                            <!-- Fallback value saat checkbox OFF (value 0 tetap terkirim) -->
                            <input type="hidden" name="ppdb_open" value="0">

                            <label class="relative inline-flex items-center cursor-pointer">

                                <input type="checkbox"
                                    name="ppdb_open"
                                    value="1"
                                    id="ppdb_open_checkbox"
                                    {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? 'checked' : '' }}
                                    class="sr-only peer">

                                <div class="w-24 h-14 bg-white/20 rounded-full peer peer-checked:bg-white/30 after:content-[''] after:absolute after:top-2 after:left-[8px] after:bg-white after:w-10 after:h-10 after:rounded-full after:transition-all peer-checked:after:translate-x-10 shadow-2xl"></div>

                            </label>

                            <div>

                                <h3 class="text-3xl font-black" id="ppdb_open_label">
                                    {{ old('ppdb_open', $profile->ppdb_open ?? 1) ? '✅ Dibuka' : '❌ Ditutup' }}
                                </h3>

                                <p class="text-emerald-100 text-lg" id="ppdb_open_desc">
                                    Pendaftaran siswa aktif
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOTO KEPSEK -->
                <div class="bg-white rounded-[35px] shadow-[0_15px_60px_rgba(0,0,0,0.08)] border border-gray-100 p-10">

                    <div class="flex items-center gap-5 mb-10">

                        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center shadow-2xl">

                            <i class="fas fa-user-tie text-white text-3xl"></i>

                        </div>

                        <div>

                            <h2 class="text-3xl font-black text-gray-900">
                                Foto Kepala Sekolah
                            </h2>

                            <p class="text-gray-500 text-lg">
                                Upload foto kepala sekolah
                            </p>

                        </div>

                    </div>

                    <!-- FOTO -->
                    <div class="flex justify-center mb-10">

                        <div class="relative group">

                            <!-- Glow -->
                            <div class="absolute inset-0 rounded-[40px] bg-gradient-to-r from-blue-500 to-indigo-600 blur-2xl opacity-30 group-hover:opacity-60 transition-all duration-500"></div>

                            <!-- Frame -->
                            <div class="relative w-80 h-80 rounded-[40px] overflow-hidden border-[10px] border-white shadow-[0_20px_80px_rgba(0,0,0,0.2)]">

                                <!-- Preview -->
                                @if($profile->foto_kepsek)

                                <img id="preview-image"
                                    src="{{ asset('storage/profiles/' . $profile->foto_kepsek) }}"
                                    alt="Foto Kepala Sekolah"
                                    class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">

                                @else

                                <img id="preview-image"
                                    src="https://ui-avatars.com/api/?name=Kepala+Sekolah&background=2563eb&color=ffffff&size=500"
                                    alt="Preview"
                                    class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">

                                @endif

                                <!-- Overlay -->
                                <label for="foto_kepsek"
                                    class="absolute inset-0 bg-black/60 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center cursor-pointer">

                                    <div class="w-24 h-24 rounded-full bg-white/20 backdrop-blur-xl flex items-center justify-center mb-5 border border-white/30">

                                        <i class="fas fa-camera text-white text-4xl"></i>

                                    </div>

                                    <span class="px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl font-black text-xl shadow-2xl">

                                        Ganti Foto

                                    </span>

                                </label>

                                <!-- Input -->
                                <input type="file"
                                    id="foto_kepsek"
                                    name="foto_kepsek"
                                    accept="image/*"
                                    class="hidden">

                            </div>

                        </div>

                    </div>

                    <!-- Nama File -->
                    <div id="file-name"
                        class="hidden text-center mb-6">

                        <div class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-green-100 text-green-700 font-bold shadow-lg">

                            <i class="fas fa-image"></i>

                            <span id="file-text"></span>

                        </div>

                    </div>

                    <!-- Sambutan -->
                    <div>

                        <label class="block text-lg font-bold text-gray-800 mb-4">
                            Sambutan Kepala Sekolah
                        </label>

                        <textarea name="sambutan_kepsek"
                            rows="8"
                            class="w-full px-6 py-5 rounded-3xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 outline-none transition-all shadow-xl resize-none">{{ $profile->sambutan_kepsek ?? '' }}</textarea>

                    </div>

                </div>

                <!-- PREVIEW -->
                <div class="relative overflow-hidden rounded-[35px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-10 shadow-[0_20px_80px_rgba(0,0,0,0.3)] text-white">

                    <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10">

                        <div class="flex items-center gap-4 mb-8">

                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-xl flex items-center justify-center">

                                <i class="fas fa-desktop text-2xl text-cyan-400"></i>

                            </div>

                            <div>

                                <h2 class="text-3xl font-black">
                                    Live Preview
                                </h2>

                                <p class="text-slate-300">
                                    Tampilan website sekolah
                                </p>

                            </div>

                        </div>

                        <!-- Card -->
                        <div class="bg-white text-gray-900 rounded-[30px] p-8 shadow-2xl">

                            <div class="text-center">

                                <img id="preview-mini"
                                    src="@if($profile->foto_kepsek){{ asset('storage/profiles/' . $profile->foto_kepsek) }}@else https://ui-avatars.com/api/?name=Kepala+Sekolah&background=2563eb&color=ffffff&size=500 @endif"
                                    class="w-32 h-32 rounded-full object-cover mx-auto border-8 border-white shadow-2xl mb-6">

                                <div class="inline-block px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black shadow-xl mb-6">

                                    <i class="fas fa-award mr-2"></i>

                                    <span class="preview-akreditasi">
                                        {{ $profile->akreditasi ?? 'Unggul' }}
                                    </span>

                                </div>

                                <h2 class="preview-nama text-3xl font-black mb-4">
                                    {{ $profile->nama_sekolah ?? 'SMPN 1 Pirime' }}
                                </h2>

                                <p class="preview-alamat text-gray-600 text-lg mb-8">
                                    {{ $profile->alamat ?? 'Alamat sekolah akan tampil di sini' }}
                                </p>

                                <div class="inline-flex items-center px-6 py-4 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold shadow-xl">

                                    <i class="fas fa-user-tie mr-3"></i>

                                    <span class="preview-kepsek">
                                        {{ $profile->kepala_sekolah ?? 'Nama Kepala Sekolah' }}
                                    </span>

                                </div>

                                <div class="mt-8 p-6 rounded-3xl bg-slate-100">

                                    <p class="preview-sambutan text-lg italic text-gray-700 leading-relaxed">
                                        "{{ Str::limit($profile->sambutan_kepsek ?? 'Sambutan kepala sekolah akan tampil di sini...', 180) }}"
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="flex flex-col sm:flex-row justify-end gap-5 pt-10 border-t border-gray-200">

            <a href="{{ route('admin.dashboard') }}"
                class="px-10 py-5 rounded-3xl border-2 border-gray-300 text-gray-700 font-black text-lg hover:bg-gray-100 transition-all shadow-xl text-center">

                <i class="fas fa-arrow-left mr-3"></i>
                Kembali

            </a>

            <button type="submit"
                class="group px-12 py-5 rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700 text-white font-black text-lg shadow-[0_20px_60px_rgba(37,99,235,0.4)] hover:scale-105 transition-all duration-300">

                <i class="fas fa-save mr-3 group-hover:animate-bounce"></i>
                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function(){

    // INPUT
    const inputs = document.querySelectorAll('#profileForm input, #profileForm textarea, #profileForm select');

    // PREVIEW ELEMENTS
    const previewNama = document.querySelector('.preview-nama');
    const previewAlamat = document.querySelector('.preview-alamat');
    const previewKepsek = document.querySelector('.preview-kepsek');
    const previewSambutan = document.querySelector('.preview-sambutan');
    const previewAkreditasi = document.querySelector('.preview-akreditasi');

    // LIVE UPDATE
    inputs.forEach(input => {

        input.addEventListener('input', function(){

            previewNama.textContent =
                document.querySelector('[name="nama_sekolah"]').value || 'SMPN 1 Pirime';

            previewAlamat.textContent =
                document.querySelector('[name="alamat"]').value || 'Alamat sekolah';

            previewKepsek.textContent =
                document.querySelector('[name="kepala_sekolah"]').value || 'Nama Kepala Sekolah';

            previewAkreditasi.textContent =
                document.querySelector('[name="akreditasi"]').value || 'Unggul';

            previewSambutan.textContent =
                '"' + (document.querySelector('[name="sambutan_kepsek"]').value || 'Sambutan kepala sekolah akan tampil di sini...') + '"';

        });

    });

    // FOTO PREVIEW (area foto + live preview mini)
    const fotoInput = document.getElementById('foto_kepsek');
    const previewImage = document.getElementById('preview-image');
    const previewMini = document.getElementById('preview-mini');

    const fileNameBox = document.getElementById('file-name');
    const fileText = document.getElementById('file-text');

    if (fotoInput) {
        fotoInput.addEventListener('change', function(e){
            const file = e.target.files && e.target.files[0] ? e.target.files[0] : null;
            if(!file) return;

            // FILE NAME
            if (fileNameBox) fileNameBox.classList.remove('hidden');
            if (fileText) fileText.textContent = file.name;

            // PREVIEW IMAGE
            const reader = new FileReader();
            reader.onload = function(event){
                if (previewImage) previewImage.src = event.target.result;
                if (previewMini) previewMini.src = event.target.result;
            }
            reader.readAsDataURL(file);
        });
    }

    // VALIDATION
    const form = document.getElementById('profileForm');

    form.addEventListener('submit', function(e){

        const requiredFields = form.querySelectorAll('[required]');

        let valid = true;

        requiredFields.forEach(field => {

            if(!field.value.trim()){

                field.classList.add('border-red-500', 'ring-4', 'ring-red-100');

                valid = false;

            }else{

                field.classList.remove('border-red-500', 'ring-4', 'ring-red-100');

            }

        });

        if(!valid){

            e.preventDefault();

            alert('Mohon isi semua data wajib.');

        }

    });

});

</script>

@endpush

@endsection