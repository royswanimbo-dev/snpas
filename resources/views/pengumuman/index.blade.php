@extends('layouts.public')

@section('title', 'Pengumuman - SMPN 1 Pirime')

@push('styles')
<style>
  @media (max-width:640px){
    .hero-title{font-size:clamp(2rem,10vw,3.5rem)!important;line-height:1.1}
    .hero-desc{font-size:clamp(1rem,5vw,1.3rem)!important}
    .featured-img-mobile{height:250px!important}
    .featured-pad-mobile{padding:1rem 1.5rem!important}
    .featured-title-mobile{font-size:1.75rem!important;line-height:1.3!important}
    .featured-excerpt-mobile{font-size:1rem!important}
    .list-thumb-mobile{height:160px!important;width:100%!important}
    .list-card-mobile{flex-direction:column!important;gap:1rem!important;height:auto!important;padding:1.5rem!important}
    .cta-mobile{font-size:1rem!important;padding:.75rem 1.5rem!important}
  }

  @media (min-width:641px) and (max-width:1024px){
    .hero-title{font-size:4rem!important}
  }

  .news-list-card,.news-featured{transition:all .35s ease}
  .news-list-card:hover,.news-featured:hover{transform:translateY(-4px)}

  .line-clamp-2{
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }

  .line-clamp-3{
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }

  .line-clamp-4{
    display:-webkit-box;
    -webkit-line-clamp:4;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }
</style>
@endpush


@section('content')

<!-- HERO -->
<section class="relative py-20 sm:py-28 lg:py-32 overflow-hidden bg-gradient-to-r from-blue-700 to-indigo-700">
    
   <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center bg-no-repeat"></div></div>
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 container mx-auto px-4 sm:px-6 text-center">
        <h1 class="hero-title text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white mb-4">
            PENGUMUMAN
        </h1>

        <p class="hero-desc text-white/90 max-w-3xl mx-auto">
            Berita & Informasi Terkini SMPN 1 Pirime
        </p>
    </div>
</section>


<!-- CONTENT -->
<div class="relative min-h-screen">

    <div class="absolute inset-0 bg-[url('/images/bg/smp.png')] bg-cover bg-center opacity-10 -z-10"></div>

    <div class="container mx-auto px-4 sm:px-6 py-16 sm:py-20">

        @forelse($pengumumans as $index => $pengumuman)

            @if($index === 0)

            <!-- BERITA UTAMA -->
            <div class="mb-16">

                <article
                    onclick="window.location='{{ route('pengumuman.show',$pengumuman->id) }}'"
                    class="news-featured bg-white/90 rounded-3xl shadow-2xl overflow-hidden border border-white/60 cursor-pointer">

                    @if($pengumuman->gambar)
                    <div class="relative featured-img-mobile h-[320px] sm:h-[420px] lg:h-[520px] overflow-hidden">

                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($pengumuman->gambar) }}"
                            alt="{{ $pengumuman->judul }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                    </div>
                    @endif

                    <div class="featured-pad-mobile p-8 sm:p-10 lg:p-14">

                        <span class="inline-flex items-center px-5 py-2 rounded-full text-white font-bold mb-6
                        @if($pengumuman->jenis == 'penting')
                            bg-red-600
                        @elseif($pengumuman->jenis == 'pengumuman')
                            bg-blue-600
                        @else
                            bg-emerald-600
                        @endif">
                            {{ ucfirst($pengumuman->jenis ?? 'Berita Utama') }}
                        </span>

                        <h2 class="featured-title-mobile text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 mb-6 line-clamp-3">
                            {{ $pengumuman->judul }}
                        </h2>

                        <div class="featured-excerpt-mobile text-gray-700 text-lg leading-relaxed mb-8 line-clamp-4">
                            {!! nl2br(e(Str::limit(strip_tags($pengumuman->isi),250))) !!}
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <div class="text-gray-600">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $pengumuman->created_at->translatedFormat('d F Y') }}
                            </div>

                            <a href="{{ route('pengumuman.show',$pengumuman->id) }}"
                               class="cta-mobile inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-7 py-3 rounded-2xl font-bold">
                                Baca Lengkap
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>

                        </div>

                    </div>
                </article>

            </div>


            <!-- LIST BERITA -->
            <div class="space-y-6">

                @for($i = 1; $i < min(6,$pengumumans->count()); $i++)

                    @php $side = $pengumumans[$i]; @endphp

                    <article
                        onclick="window.location='{{ route('pengumuman.show',$side->id) }}'"
                        class="news-list-card bg-white/85 rounded-2xl shadow-xl border border-white/50 p-6 cursor-pointer">

                        <div class="flex flex-col lg:flex-row gap-5">

                            @if($side->gambar)
                            <div class="list-thumb-mobile w-full lg:w-52 lg:h-36 rounded-2xl overflow-hidden flex-shrink-0">

                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::url($side->gambar) }}"
                                    alt="{{ $side->judul }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

                            </div>
                            @endif

                            <div class="flex-1">

                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-3
                                @if($side->jenis == 'penting')
                                    bg-red-100 text-red-700
                                @elseif($side->jenis == 'pengumuman')
                                    bg-blue-100 text-blue-700
                                @else
                                    bg-emerald-100 text-emerald-700
                                @endif">
                                    {{ ucfirst($side->jenis ?? 'Berita') }}
                                </span>

                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    {{ $side->judul }}
                                </h3>

                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $side->created_at->format('d M Y') }}
                                </div>

                            </div>

                        </div>

                    </article>

                @endfor

            </div>

            @endif

        @empty

        <!-- KOSONG -->
        <div class="text-center py-28">

            <div class="w-28 h-28 rounded-3xl bg-gray-100 mx-auto flex items-center justify-center mb-7 shadow-xl">
                <i class="fas fa-bullhorn text-4xl text-gray-500"></i>
            </div>

            <h2 class="text-4xl font-black text-gray-800 mb-4">
                Tidak Ada Pengumuman
            </h2>

            <p class="text-gray-600 text-xl mb-10">
                Silakan cek kembali untuk update terbaru.
            </p>

            <a href="{{ route('ppdb') }}"
               class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white px-10 py-4 rounded-2xl font-bold">
                <i class="fas fa-clipboard-list mr-2"></i>
                PPDB Online
            </a>

        </div>

        @endforelse


        @if(($pengumumans->count() ?? 0) > 6)
        <div class="text-center mt-16 pt-10 border-t">

            <a href="#"
               class="inline-flex items-center bg-gray-100 hover:bg-blue-50 text-gray-800 px-10 py-4 rounded-2xl font-bold">

                <i class="fas fa-list mr-2"></i>
                Lihat Semua Pengumuman

            </a>

        </div>
        @endif

    </div>
</div>

@endsection