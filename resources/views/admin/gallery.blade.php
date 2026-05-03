@extends('layouts.app')

@section('title', 'Kelola Galeri - Admin')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;
@endphp
<div class="p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kelola Galeri Foto</h1>
            <p class="text-gray-600 mt-1">Tambah, edit, dan hapus foto galeri sekolah</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" 
           class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-semibold shadow-xl hover:shadow-2xl hover:bg-blue-700 transition-all duration-300 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah Foto
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-6 shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="p-8 border-b border-gray-200">
            <div class="flex flex-wrap gap-4 items-center">
                <i class="fas fa-images text-3xl text-blue-600"></i>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Galeri</h2>
                    <p class="text-gray-600">{{ $galleries->count() }} foto tersedia</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gambar</th>
                        <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                        <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-8 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-8 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($galleries as $gallery)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-8 py-6">
                            <img src="{{ Storage::url($gallery->image) }}" 
                                 alt="{{ $gallery->title }}"
                                 class="w-20 h-20 object-cover rounded-xl shadow-md hover:shadow-xl transition-shadow">
                        </td>
                        <td class="px-8 py-6 font-medium text-gray-900 max-w-xs truncate" title="{{ $gallery->title }}">
                            {{ Str::limit($gallery->title, 50) }}
                        </td>
                        <td class="px-8 py-6">
                            <span class="inline-flex px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">{{ $gallery->kategori }}</span>
                            <div class="text-gray-600 text-sm max-w-md mt-1" title="{{ $gallery->description }}">
                                {{ Str::limit($gallery->description ?? 'Tidak ada deskripsi', 60) }}
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm text-gray-500">
                            {{ $gallery->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center gap-2 justify-center">
                                <a href="{{ route('admin.gallery.edit', $gallery) }}" 
                                   class="text-blue-600 hover:text-blue-900 font-medium p-2 hover:bg-blue-50 rounded-xl transition-all">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 font-medium p-2 hover:bg-red-50 rounded-xl transition-all">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <i class="fas fa-images text-6xl text-gray-300 mb-6"></i>
                            <p class="text-xl text-gray-500">Belum ada foto galeri</p>
                            <a href="{{ route('admin.gallery.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-3 rounded-2xl font-semibold hover:bg-blue-700">
                                Tambah Foto Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

