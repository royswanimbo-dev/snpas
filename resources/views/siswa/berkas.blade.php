@extends('layouts.app')

@section('title', 'Upload Berkas PPDB')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-100 py-8 px-3">

    <div class="max-w-5xl mx-auto">

        <!-- HEADER -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/40 p-6 md:p-8 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg">
                        <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                    </div>

                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-slate-800">
                            Upload Berkas PPDB
                        </h1>
                        <p class="text-slate-500 text-sm mt-1">
                            Lengkapi seluruh dokumen pendaftaran siswa baru.
                        </p>
                    </div>
                </div>

                <a href="{{ url()->previous() }}"
                   class="px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>

            </div>
        </div>

        <!-- ALERT -->
        @if(session('success'))
        <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 px-5 py-4 shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-circle-check text-emerald-600 text-xl"></i>
                <span class="font-semibold text-emerald-700">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('siswa.ppdb.berkas.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid lg:grid-cols-3 gap-6">

                <!-- LEFT -->
                <div class="lg:col-span-2">

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/40 p-6 md:p-8">

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-folder-open text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-slate-800 text-lg">Form Upload Dokumen</h3>
                                <p class="text-sm text-slate-500">Format file sesuai ketentuan</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-5">

                            <!-- FOTO PROFIL -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Foto Profil
                                </label>
                                <input type="file" name="foto_profil"
                                    class="w-full rounded-2xl border border-slate-200 p-3 bg-white shadow-sm"
                                    accept="image/*">
                                <p class="text-xs text-slate-400 mt-1">JPG / PNG max 2MB</p>
                            </div>

                            <!-- FOTO 3x4 -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Foto 3×4
                                </label>
                                <input type="file" name="foto"
                                    class="w-full rounded-2xl border border-slate-200 p-3 bg-white shadow-sm">
                                <p class="text-xs text-slate-400 mt-1">JPG / PNG max 2MB</p>
                            </div>

                            <!-- KK -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Kartu Keluarga
                                </label>
                                <input type="file" name="kk"
                                    class="w-full rounded-2xl border border-slate-200 p-3 bg-white shadow-sm">
                                <p class="text-xs text-slate-400 mt-1">PDF / JPG / PNG max 2MB</p>
                            </div>

                            <!-- AKTA -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Akta Kelahiran
                                </label>
                                <input type="file" name="akta"
                                    class="w-full rounded-2xl border border-slate-200 p-3 bg-white shadow-sm">
                                <p class="text-xs text-slate-400 mt-1">PDF / JPG / PNG max 2MB</p>
                            </div>

                            <!-- SKL -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Surat Keterangan Lulus
                                </label>
                                <input type="file" name="skl"
                                    class="w-full rounded-2xl border border-slate-200 p-3 bg-white shadow-sm">
                                <p class="text-xs text-slate-400 mt-1">PDF / JPG / PNG max 2MB</p>
                            </div>

                            <!-- RAPOR -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Rapor Semester Terakhir
                                </label>
                                <input type="file" name="rapor"
                                    class="w-full rounded-2xl border border-slate-200 p-3 bg-white shadow-sm">
                                <p class="text-xs text-slate-400 mt-1">PDF max 5MB</p>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-8">
                            <button type="submit"
                                class="w-full md:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-green-600 text-white font-black shadow-lg hover:scale-[1.02] transition">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Berkas
                            </button>
                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/40 p-6">

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-11 h-11 rounded-xl bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-file-shield text-indigo-600"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-slate-800">Berkas Saat Ini</h3>
                                <p class="text-sm text-slate-500">Status dokumen Anda</p>
                            </div>
                        </div>

                        <div class="space-y-4">

                            @php
                            $files = [
                                'Foto Profil' => $pendaftar->foto_profil,
                                'Foto 3x4' => $pendaftar->foto,
                                'Kartu Keluarga' => $pendaftar->kk,
                                'Akta Kelahiran' => $pendaftar->akte,
                                'Ijazah' => $pendaftar->ijazah,
                                'Kartu NISN' => $pendaftar->kartu_nisn,
                            ];
                            @endphp

                            @foreach($files as $label => $file)
                            <div class="rounded-2xl border border-slate-100 p-4 hover:shadow-md transition bg-white">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-slate-700 text-sm">{{ $label }}</p>
                                    </div>

                                    @if($file)
                                        <a href="{{ asset('storage/'.$file) }}"
                                           target="_blank"
                                           class="px-4 py-2 rounded-xl bg-emerald-100 text-emerald-700 font-bold text-xs hover:bg-emerald-200 transition">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </a>
                                    @else
                                        <span class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-bold text-xs">
                                            Belum Upload
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="mt-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-3xl shadow-xl p-6">
                        <h4 class="font-black text-lg mb-2">
                            Tips Upload
                        </h4>
                        <ul class="space-y-2 text-sm text-blue-100">
                            <li>• Pastikan file jelas dan tidak blur</li>
                            <li>• Gunakan scan/foto berkualitas baik</li>
                            <li>• Ukuran file sesuai ketentuan</li>
                            <li>• Upload ulang jika ingin mengganti file</li>
                        </ul>
                    </div>

                </div>

            </div>

        </form>

    </div>

</div>
@endsection