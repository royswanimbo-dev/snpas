@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Status Pendaftaran</h1>
                <p class="text-blue-100">Pantau status pendaftaran PPDB Anda</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-clipboard-check text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    @if($pendaftar)
        <!-- Status Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Status Pendaftaran Anda
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Nomor Pendaftaran:</span>
                            <span class="font-semibold text-gray-800">{{ $pendaftar->nomor_pendaftaran ?? 'Belum ada' }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Status:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($pendaftar->status == 'Diterima') bg-green-100 text-green-800
                                @elseif($pendaftar->status == 'Ditolak') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $pendaftar->status ?? 'Menunggu' }}
                            </span>
                        </div>

                        @if($pendaftar->catatan_admin)
                            <div class="p-4 rounded-lg border-l-4
                                @if($pendaftar->status == 'Diterima') bg-green-50 border-green-400
                                @elseif($pendaftar->status == 'Ditolak') bg-red-50 border-red-400
                                @else bg-amber-50 border-amber-400 @endif">
                                <div class="flex items-start gap-3">
                                    <i class="fas
                                        @if($pendaftar->status == 'Diterima') fa-check-circle text-green-500
                                        @elseif($pendaftar->status == 'Ditolak') fa-times-circle text-red-500
                                        @else fa-clock text-amber-500 @endif text-xl mt-0.5"></i>
                                    <div>
                                        <span class="font-medium block mb-1
                                            @if($pendaftar->status == 'Diterima') text-green-800
                                            @elseif($pendaftar->status == 'Ditolak') text-red-800
                                            @else text-amber-800 @endif">Catatan Admin:</span>
                                        <p class="
                                            @if($pendaftar->status == 'Diterima') text-green-700
                                            @elseif($pendaftar->status == 'Ditolak') text-red-700
                                            @else text-amber-700 @endif">{{ $pendaftar->catatan_admin }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Nama Lengkap:</span>
                            <span class="font-semibold text-gray-800">{{ $pendaftar->nama_lengkap }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">NISN:</span>
                            <span class="font-semibold text-gray-800">{{ $pendaftar->nisn ?? '-' }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Jenis Kelamin:</span>
                            <span class="font-semibold text-gray-800">{{ $pendaftar->jenis_kelamin }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Sekolah Asal:</span>
                            <span class="font-semibold text-gray-800">{{ $pendaftar->nama_sekolah }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Information -->
        @if($pendaftar->status == 'Menunggu' || !$pendaftar->status)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-yellow-800">Menunggu Verifikasi Admin</h3>
                        <div class="mt-2 text-yellow-700">
                            <p>Data pendaftaran Anda telah tersimpan dan sedang menunggu verifikasi dari admin. Proses verifikasi biasanya memakan waktu 1-3 hari kerja.</p>
                            <div class="mt-3">
                                <h4 class="font-medium">Langkah selanjutnya:</h4>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li>Admin akan memverifikasi data dan berkas yang Anda upload</li>
                                    <li>Anda akan menerima notifikasi melalui email jika ada perubahan status</li>
                                    <li>Silakan cek status secara berkala atau hubungi admin jika ada pertanyaan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($pendaftar->status == 'Diterima')
            <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Selamat! Pendaftaran Diterima</h3>
                        <div class="mt-2 text-green-700">
                            <p>Pendaftaran Anda telah diterima. Silakan cetak bukti pendaftaran dan bawa ke sekolah untuk proses selanjutnya.</p>
                            <div class="mt-4">
                                <a href="{{ route('siswa.cetak') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                    <i class="fas fa-print mr-2"></i>Cetak Bukti Pendaftaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($pendaftar->status == 'Ditolak')
            <div class="bg-red-50 border-l-4 border-red-400 p-6 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-times-circle text-red-400 text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-red-800">Pendaftaran Ditolak</h3>
                        <div class="mt-2 text-red-700">
                            <p>Mohon maaf, pendaftaran Anda tidak dapat diterima. Silakan periksa catatan admin untuk informasi lebih lanjut.</p>
                            <div class="mt-4">
                                <a href="{{ route('siswa.pendaftaran') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                    <i class="fas fa-edit mr-2"></i>Edit Pendaftaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('siswa.pendaftaran') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 text-center">
                <i class="fas fa-edit text-3xl text-blue-500 mb-3"></i>
                <h3 class="font-semibold text-gray-800 mb-2">Edit Pendaftaran</h3>
                <p class="text-gray-600 text-sm">Ubah data pendaftaran Anda</p>
            </a>

            <a href="{{ route('siswa.ppdb.berkas') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 text-center">
                <i class="fas fa-file-upload text-3xl text-green-500 mb-3"></i>
                <h3 class="font-semibold text-gray-800 mb-2">Upload Berkas</h3>
                <p class="text-gray-600 text-sm">Kelola berkas persyaratan</p>
            </a>

            <a href="{{ route('siswa.cetak') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 text-center">
                <i class="fas fa-print text-3xl text-purple-500 mb-3"></i>
                <h3 class="font-semibold text-gray-800 mb-2">Cetak Bukti</h3>
                <p class="text-gray-600 text-sm">Download bukti pendaftaran</p>
            </a>
        </div>
    @else
        <!-- No Registration Alert -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-yellow-800">Belum Ada Data Pendaftaran</h3>
                    <div class="mt-2 text-yellow-700">
                        <p>Anda belum mengisi formulir pendaftaran PPDB. Silakan lengkapi formulir pendaftaran terlebih dahulu untuk dapat melihat status pendaftaran Anda.</p>
                        <div class="mt-4">
                            <a href="{{ route('siswa.pendaftaran') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>Isi Formulir Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
