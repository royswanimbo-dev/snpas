@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Dashboard Admin</h1>
                <p class="text-blue-100">Selamat datang, {{ auth()->user()->name }}</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-tachometer-alt text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium flex items-center">
                            <i class="fas fa-users mr-2"></i>Total Pendaftar
                        </p>
                        <p class="text-white text-3xl font-bold">{{ $jumlahPendaftar }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <a href="{{ route('admin.pendaftar') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                    <i class="fas fa-users mr-3"></i>Lihat Data
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Belum Diverifikasi -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Belum Diverifikasi</p>
                        <p class="text-white text-3xl font-bold">{{ $belumVerifikasi }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <a href="{{ route('admin.pendaftar') }}" class="inline-flex items-center text-orange-600 hover:text-orange-800 font-medium transition-colors duration-200">
                    <i class="fas fa-check-circle mr-3"></i>Verifikasi Sekarang
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Sudah Diverifikasi -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>Sudah Diverifikasi
                        </p>
                        <p class="text-white text-3xl font-bold">{{ $sudahDiverifikasi }}</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="flex space-x-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Diterima</p>
                        <p class="text-lg font-bold text-green-600">{{ $diterima }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Ditolak</p>
                        <p class="text-lg font-bold text-red-600">{{ $ditolak }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium flex items-center">
                            <i class="fas fa-cogs mr-2"></i>Aksi Cepat
                        </p>
                        <p class="text-white text-lg font-semibold">Kelola Sistem</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <i class="fas fa-cogs text-white text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="p-4 space-y-2">
                <a href="{{ route('admin.laporan') }}" class="block text-purple-600 hover:text-purple-800 font-medium transition-colors duration-200">
                    <i class="fas fa-file-alt mr-2"></i>Laporan PPDB
                </a>
                <a href="{{ route('admin.pengumuman') }}" class="block text-purple-600 hover:text-purple-800 font-medium transition-colors duration-200">
                    <i class="fas fa-bullhorn mr-2"></i>Kelola Pengumuman
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Registrations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Pendaftar Terbaru -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-plus text-blue-500 mr-2"></i>Pendaftar Terbaru
            </h2>
            <div class="space-y-3">
                @forelse($pendaftarTerbaru as $pendaftar)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 mr-3">
                                @if($pendaftar->foto_profil)
                                    <img src="{{ asset('storage/' . $pendaftar->foto_profil) }}" alt="Foto {{ $pendaftar->nama_lengkap }}"
                                         class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xs border border-gray-200">
                                        {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $pendaftar->nama_lengkap }}</p>
                                <p class="text-sm text-gray-600">{{ $pendaftar->user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($pendaftar->status == 'Menunggu') bg-yellow-100 text-yellow-800
                                @elseif($pendaftar->status == 'Diterima') bg-green-100 text-green-800
                                @elseif($pendaftar->status == 'Ditolak') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $pendaftar->status ?? 'Menunggu' }}
                            </span>
                            <p class="text-xs text-gray-500 mt-1">{{ $pendaftar->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2"></i>
                        <p>Belum ada pendaftar baru</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Stats Overview -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-pie text-green-500 mr-2"></i>Ringkasan PPDB
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Pendaftar</span>
                    <span class="font-bold text-lg">{{ $jumlahPendaftar }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Menunggu Verifikasi</span>
                    <span class="font-bold text-lg text-yellow-600">{{ $belumVerifikasi }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Sudah Diverifikasi</span>
                    <span class="font-bold text-lg text-green-600">{{ $sudahDiverifikasi }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Diterima</span>
                    <span class="font-bold text-lg text-blue-600">{{ $diterima }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Ditolak</span>
                    <span class="font-bold text-lg text-red-600">{{ $ditolak }}</span>
                </div>
                <hr class="my-4">
                <div class="flex justify-between items-center font-semibold">
                    <span class="text-gray-800">Persentase Diterima</span>
                    <span class="text-lg {{ $jumlahPendaftar > 0 ? ($diterima / $jumlahPendaftar * 100 >= 50 ? 'text-green-600' : 'text-yellow-600') : 'text-gray-600' }}">
                        {{ $jumlahPendaftar > 0 ? round(($diterima / $jumlahPendaftar) * 100, 1) : 0 }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity or Additional Info -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Sistem</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="text-center">
                <i class="fas fa-school text-4xl text-blue-500 mb-2"></i>
                <h3 class="text-lg font-medium text-gray-800">SMP YPK Kotaraja</h3>
                <p class="text-gray-600">Sistem PPDB Online</p>
            </div>
            <div class="text-center">
                <i class="fas fa-calendar-alt text-4xl text-green-500 mb-2"></i>
                <h3 class="text-lg font-medium text-gray-800">Tahun Ajaran</h3>
                <p class="text-gray-600">{{ date('Y') }}/{{ date('Y')+1 }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
