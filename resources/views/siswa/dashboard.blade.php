@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@push('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
    }
    .quick-action-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .quick-action-card::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s ease;
    }
    .quick-action-card:hover::before {
        left: 100%;
    }
    .quick-action-card:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 15px 30px -8px rgba(0, 0, 0, 0.2);
    }
    .profile-banner {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 50%, #e0e7ff 100%);
        border-bottom: 1px solid rgba(59, 130, 246, 0.2);
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-in {
        animation: slideIn 0.5s ease forwards;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .progress-ring-circle {
        transition: stroke-dashoffset 0.5s ease;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100">

    <!-- Profile Banner -->
    <div class="profile-banner relative overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <!-- Avatar -->
                <div class="relative">
                    <div class="w-24 h-24 rounded-2xl bg-white border-4 border-blue-200 flex items-center justify-center shadow-xl">
                        @if($pendaftar && $pendaftar->foto_profil)
                            <img src="{{ asset('storage/'.$pendaftar->foto_profil) }}" alt="Foto Profil" class="w-full h-full object-cover rounded-xl">
                        @else
                            <i class="fas fa-user-graduate text-4xl text-blue-600"></i>
                        @endif
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>

                <!-- Info -->
                <div class="text-center md:text-left flex-1">
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-1 drop-shadow-sm">
                        {{ $pendaftar ? $pendaftar->nama_lengkap : auth()->user()->name }}
                    </h1>
                    <p class="text-slate-700 text-sm mb-3 font-medium">
                        {{ $pendaftar ? $pendaftar->nisn ?? 'NISN Belum Diisi' : 'Calon Siswa Baru' }}
                    </p>
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-2">
                        <span class="px-4 py-1.5 bg-blue-600 rounded-full text-white text-xs font-bold border border-blue-500 shadow-md">
                            <i class="fas fa-id-card mr-1.5"></i>
                            {{ $pendaftar ? ($pendaftar->nomor_pendaftaran ?? 'Menunggu Nomor') : 'Belum Mendaftar' }}
                        </span>
                        @if($pendaftar)
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold border-2 shadow-sm
                            @if($pendaftar->status == 'Diterima') bg-emerald-100 text-emerald-800 border-emerald-400
                            @elseif($pendaftar->status == 'Ditolak') bg-red-100 text-red-800 border-red-400
                            @else bg-amber-100 text-amber-800 border-amber-400 @endif">
                            <i class="fas fa-circle text-[8px] mr-1.5 animate-pulse"></i>
                            {{ $pendaftar->status ?? 'Menunggu Verifikasi' }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Date & Badge -->
                <div class="text-center md:text-right">
                    <p class="text-slate-800 text-sm font-semibold">{{ date('l, d F Y') }}</p>
                    <p class="text-slate-600 text-xs mt-1 font-medium">Tahun Ajaran 2025/2026</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 -mt-4">

    @if ($pendaftar)

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

            @php
                $berkasCount = 0;
                if($pendaftar->foto_profil) $berkasCount++;
                if($pendaftar->foto) $berkasCount++;
                if($pendaftar->kk) $berkasCount++;
                if($pendaftar->akte) $berkasCount++;
                if($pendaftar->ijazah) $berkasCount++;
                if($pendaftar->kartu_nisn) $berkasCount++;
                $progress = $berkasCount > 0 ? ($berkasCount / 6) * 100 : 0;
            @endphp

            <!-- Status Card -->
            <div class="stat-card glass-card rounded-2xl p-6 shadow-lg animate-slide-in">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center
                        @if($pendaftar->status == 'Diterima') bg-gradient-to-br from-emerald-400 to-emerald-600 shadow-emerald-200
                        @elseif($pendaftar->status == 'Ditolak') bg-gradient-to-br from-red-400 to-red-600 shadow-red-200
                        @else bg-gradient-to-br from-amber-400 to-amber-600 shadow-amber-200 @endif"
                        style="box-shadow: 0 10px 30px -5px var(--tw-shadow-color);">
                        <i class="fas
                            @if($pendaftar->status == 'Diterima') fa-check
                            @elseif($pendaftar->status == 'Ditolak') fa-xmark
                            @else fa-clock @endif text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</span>
                </div>
                <p class="text-2xl font-bold text-slate-800 mb-1">
                    @if($pendaftar->status == 'Diterima') Diterima
                    @elseif($pendaftar->status == 'Ditolak') Ditolak
                    @else Menunggu @endif
                </p>
                <p class="text-sm text-slate-500">Status pendaftaran PPDB</p>
            </div>

            <!-- Berkas Progress Card -->
            <div class="stat-card glass-card rounded-2xl p-6 shadow-lg animate-slide-in delay-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-blue-200" style="box-shadow: 0 10px 30px -5px rgba(59,130,246,0.3);">
                        <i class="fas fa-folder-open text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Berkas</span>
                </div>
                <div class="flex items-end justify-between mb-2">
                    <p class="text-2xl font-bold text-slate-800">{{ $berkasCount }}<span class="text-lg text-slate-400">/6</span></p>
                    <p class="text-sm font-bold text-blue-600">{{ number_format($progress, 0) }}%</p>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-1000 ease-out" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <!-- Nomor Pendaftaran Card -->
            <div class="stat-card glass-card rounded-2xl p-6 shadow-lg animate-slide-in delay-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-400 to-purple-600 flex items-center justify-center shadow-purple-200" style="box-shadow: 0 10px 30px -5px rgba(139,92,246,0.3);">
                        <i class="fas fa-hashtag text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">No. Daftar</span>
                </div>
                <p class="text-2xl font-bold text-slate-800 mb-1 font-mono tracking-tight">
                    {{ $pendaftar->nomor_pendaftaran ?? '---' }}
                </p>
                <p class="text-sm text-slate-500">Nomor pendaftaran PPDB</p>
            </div>
        </div>

        <!-- Alert Status -->
        @if($pendaftar->status == 'Menunggu' || !$pendaftar->status)
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-5 mb-8 flex items-start gap-4 shadow-sm animate-slide-in delay-300">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-circle-info text-amber-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-amber-800">Pendaftaran sedang diproses</p>
                    <p class="text-sm text-amber-700 mt-1">Data Anda sedang dalam tahap verifikasi. Pastikan semua berkas telah diunggah dengan lengkap.</p>
                </div>
                <a href="{{ route('siswa.ppdb.berkas') }}" class="hidden sm:inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-xl transition-colors shrink-0">
                    <i class="fas fa-upload mr-2"></i>Lengkapi Berkas
                </a>
            </div>
        @elseif($pendaftar->status == 'Diterima')
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 rounded-2xl p-5 mb-8 flex items-start gap-4 shadow-sm animate-slide-in delay-300">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-circle-check text-emerald-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-emerald-800">Selamat, pendaftaran Anda diterima!</p>
                    <p class="text-sm text-emerald-700 mt-1">Silakan cetak bukti pendaftaran dan bawa ke sekolah untuk proses daftar ulang.</p>
                </div>
                <a href="{{ route('siswa.cetak') }}" class="hidden sm:inline-flex items-center px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-medium rounded-xl transition-colors shrink-0">
                    <i class="fas fa-print mr-2"></i>Cetak Bukti
                </a>
            </div>
        @elseif($pendaftar->status == 'Ditolak')
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl p-5 mb-8 flex items-start gap-4 shadow-sm animate-slide-in delay-300">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-circle-xmark text-red-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-red-800">Pendaftaran tidak dapat diterima</p>
                    <p class="text-sm text-red-700 mt-1">Silakan hubungi admin sekolah untuk informasi lebih lanjut.</p>
                </div>
                <a href="{{ route('siswa.pendaftaran') }}" class="hidden sm:inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-xl transition-colors shrink-0">
                    <i class="fas fa-edit mr-2"></i>Edit Data
                </a>
            </div>
        @endif

        <!-- Quick Actions Grid -->
        <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
            <i class="fas fa-bolt text-yellow-500 mr-2"></i>Menu Cepat
        </h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <a href="{{ route('siswa.pendaftaran') }}" class="quick-action-card glass-card rounded-2xl p-6 border border-blue-100 hover:border-blue-300 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center mb-4 shadow-lg shadow-blue-200 group-hover:shadow-blue-300 transition-all">
                    <i class="fas fa-user-pen text-white"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-800 mb-1">Edit Pendaftaran</h3>
                <p class="text-xs text-slate-500">Ubah data diri & berkas</p>
            </a>

            <a href="{{ route('siswa.ppdb.berkas') }}" class="quick-action-card glass-card rounded-2xl p-6 border border-emerald-100 hover:border-emerald-300 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center mb-4 shadow-lg shadow-emerald-200 group-hover:shadow-emerald-300 transition-all">
                    <i class="fas fa-cloud-arrow-up text-white"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-800 mb-1">Upload Berkas</h3>
                <p class="text-xs text-slate-500">Kelola dokumen wajib</p>
            </a>

            <a href="{{ route('siswa.status') }}" class="quick-action-card glass-card rounded-2xl p-6 border border-amber-100 hover:border-amber-300 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center mb-4 shadow-lg shadow-amber-200 group-hover:shadow-amber-300 transition-all">
                    <i class="fas fa-list-check text-white"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-800 mb-1">Cek Status</h3>
                <p class="text-xs text-slate-500">Pantau progress</p>
            </a>

            <a href="{{ route('siswa.cetak') }}" class="quick-action-card glass-card rounded-2xl p-6 border border-purple-100 hover:border-purple-300 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center mb-4 shadow-lg shadow-purple-200 group-hover:shadow-purple-300 transition-all">
                    <i class="fas fa-file-arrow-down text-white"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-800 mb-1">Cetak Bukti</h3>
                <p class="text-xs text-slate-500">Download PDF</p>
            </a>
        </div>

        <!-- Data Pendaftaran Section -->
        <div class="glass-card rounded-2xl shadow-lg overflow-hidden animate-slide-in delay-400">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-white to-slate-50">
                <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center">
                    <i class="fas fa-id-badge text-blue-500 mr-2"></i>Data Pendaftaran
                </h2>
                <a href="{{ route('siswa.pendaftaran') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                    <i class="fas fa-pen mr-1"></i>Edit
                </a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-0">
                    @foreach([
                        ['Nama Lengkap', $pendaftar->nama_lengkap ?? '-'],
                        ['NISN', $pendaftar->nisn ?? '-'],
                        ['Jenis Kelamin', $pendaftar->jenis_kelamin ?? '-'],
                        ['Tempat, Tanggal Lahir', ($pendaftar->tempat_lahir ?? '-') . ($pendaftar->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d M Y') : '')],
                        ['Agama', $pendaftar->agama ?? '-'],
                        ['No. HP', $pendaftar->no_hp_siswa ?? '-'],
                        ['Alamat', $pendaftar->alamat ?? '-'],
                        ['Desa/Kecamatan', ($pendaftar->desa ?? '-') . ($pendaftar->kecamatan ? ', ' . $pendaftar->kecamatan : '')],
                        ['Sekolah Asal', $pendaftar->nama_sekolah ?? '-'],
                        ['NPSN', $pendaftar->npsn ?? '-'],
                        ['Nama Ayah', $pendaftar->nama_ayah ?? '-'],
                        ['Nama Ibu', $pendaftar->nama_ibu ?? '-'],
                    ] as [$label, $value])
                    <div class="flex justify-between items-center py-3 border-b border-slate-100 last:border-b-0">
                        <span class="text-sm text-slate-500 font-medium">{{ $label }}</span>
                        <span class="text-sm font-semibold text-slate-800 text-right max-w-[60%]">{{ $value }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    @else
        <!-- Belum Daftar State -->
        <div class="max-w-2xl mx-auto">
            <div class="glass-card rounded-3xl p-10 text-center shadow-2xl animate-slide-in">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-clipboard-list text-3xl text-blue-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-3">Belum Melakukan Pendaftaran</h2>
                <p class="text-slate-500 mb-8 max-w-md mx-auto">Anda belum mengisi formulir PPDB. Silakan lengkapi data pendaftaran untuk melanjutkan ke tahap selanjutnya.</p>
                <a href="{{ route('siswa.pendaftaran') }}" class="inline-flex items-center px-8 py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 transition-all hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i>Mulai Pendaftaran Sekarang
                </a>
            </div>

            <!-- Alur Pendaftaran -->
            <div class="mt-8">
                <h3 class="text-center text-sm font-bold text-slate-500 uppercase tracking-wider mb-6">Alur Pendaftaran</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach([
                        ['1', 'Isi Formulir', 'Lengkapi data pribadi', 'fa-file-lines', 'from-blue-500 to-blue-600'],
                        ['2', 'Upload Berkas', 'Unggah dokumen wajib', 'fa-cloud-arrow-up', 'from-emerald-500 to-emerald-600'],
                        ['3', 'Verifikasi', 'Tunggu konfirmasi admin', 'fa-check-double', 'from-purple-500 to-purple-600']
                    ] as [$num, $title, $desc, $icon, $gradient])
                    <div class="glass-card rounded-2xl p-6 text-center shadow-lg relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r {{ $gradient }}"></div>
                        <div class="w-12 h-12 bg-gradient-to-br {{ $gradient }} rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg text-white group-hover:scale-110 transition-transform">
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <div class="w-6 h-6 rounded-full bg-slate-800 text-white flex items-center justify-center mx-auto mb-3 text-xs font-bold">{{ $num }}</div>
                        <h3 class="text-sm font-bold text-slate-800 mb-1">{{ $title }}</h3>
                        <p class="text-xs text-slate-500">{{ $desc }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
@endsection

