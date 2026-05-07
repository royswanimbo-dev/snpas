@extends('layouts.public')

@section('title', $pengumuman->judul . ' - SMPN 1 Pirime')

@section('content')
<div class="py-20">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Back Button -->
        <a href="{{ route('pengumuman') }}" class="inline-flex items-center mb-8 text-blue-600 hover:text-blue-800 font-semibold group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Pengumuman
        </a>

        <article class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/60">
            <div class="relative">
                @if($pengumuman->gambar)
                    <div class="h-96 sm:h-[420px] overflow-hidden">
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($pengumuman->gambar) }}"
                            alt="{{ $pengumuman->judul }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    </div>
                @else
                    <div class="h-96 sm:h-[420px] bg-gray-100 flex items-center justify-center">
                        <img src="{{ asset('images/no-image.png') }}" alt="Tidak ada gambar" class="max-w-xs opacity-80" />
                    </div>
                @endif
            </div>

            <div class="p-12 lg:p-16">
                <!-- Badge -->
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r
                    @if($pengumuman->jenis == 'penting') from-red-500 to-red-600
                    @elseif($pengumuman->jenis == 'pengumuman') from-blue-500 to-blue-600
                    @else from-green-500 to-green-600 @endif text-white shadow-lg mb-6">
                    <i class="fas fa-{{ $pengumuman->jenis == 'penting' ? 'exclamation-triangle' : ($pengumuman->jenis == 'pengumuman' ? 'bullhorn' : 'info-circle') }} mr-2"></i>
                    {{ ucfirst($pengumuman->jenis ?? 'Informasi') }}
                </span>

                <!-- Title -->
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-8 leading-tight">
                    {{ $pengumuman->judul }}
                </h1>

                <!-- Meta -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $pengumuman->tanggal_publish ? $pengumuman->tanggal_publish->translatedFormat('d F Y H:i') : $pengumuman->created_at->translatedFormat('d F Y H:i') }}
                    </div>

                    @if($pengumuman->aktif)
                        <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                            <i class="fas fa-eye mr-1"></i>Aktif
                        </span>
                    @endif
                </div>

                <!-- Full Content -->
                <div class="prose prose-xl max-w-none text-gray-800 leading-relaxed text-justify space-y-4">
                    {!! nl2br(e($pengumuman->isi)) !!}
                </div>
            </div>
        </article>
    </div>
</div>
@endsection

