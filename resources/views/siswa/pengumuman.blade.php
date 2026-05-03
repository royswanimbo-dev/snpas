@extends('layouts.app')

@section('title', 'Pengumuman - Siswa')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                    <i class="fas fa-bullhorn text-4xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">Pengumuman</h1>
                    <p class="text-blue-100">Informasi terbaru dari SMP YPK Kotaraja</p>
                </div>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-info-circle text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    @if($pengumumans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pengumumans as $pengumuman)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($pengumuman->gambar)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/pengumuman/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if($pengumuman->jenis == 'penting') bg-red-100 text-red-800
                                @elseif($pengumuman->jenis == 'pengumuman') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800 @endif">
                                <i class="fas fa-{{ $pengumuman->jenis == 'penting' ? 'exclamation-triangle' : ($pengumuman->jenis == 'pengumuman' ? 'bullhorn' : 'info-circle') }} mr-1"></i>
                                {{ ucfirst($pengumuman->jenis) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y') : $pengumuman->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $pengumuman->judul }}</h3>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($pengumuman->isi, 150) }}</p>

                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center justify-center" data-bs-toggle="modal" data-bs-target="#pengumumanModal{{ $pengumuman->id }}">
                            <i class="fas fa-eye mr-2"></i>Baca Selengkapnya
                        </button>
                    </div>
                </div>

                <!-- Modal for full announcement -->
                <div class="modal fade" id="pengumumanModal{{ $pengumuman->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-bold">{{ $pengumuman->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if($pengumuman->gambar)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/pengumuman/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full rounded-lg">
                                    </div>
                                @endif

                                <div class="flex items-center space-x-4 mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if($pengumuman->jenis == 'penting') bg-red-100 text-red-800
                                        @elseif($pengumuman->jenis == 'pengumuman') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        <i class="fas fa-{{ $pengumuman->jenis == 'penting' ? 'exclamation-triangle' : ($pengumuman->jenis == 'pengumuman' ? 'bullhorn' : 'info-circle') }} mr-1"></i>
                                        {{ ucfirst($pengumuman->jenis) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Dipublikasikan: {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->format('d M Y H:i') : $pengumuman->created_at->format('d M Y H:i') }}
                                    </span>
                                </div>

                                <div class="prose max-w-none">
                                    {!! nl2br(e($pengumuman->isi)) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Announcements -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400 text-2xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-blue-800">Belum Ada Pengumuman</h3>
                    <div class="mt-2 text-blue-700">
                        <p>Saat ini belum ada pengumuman yang tersedia. Silakan kembali lagi nanti untuk informasi terbaru.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
