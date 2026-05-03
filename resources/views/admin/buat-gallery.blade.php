@extends('layouts.app')

@section('title', 'Tambah Galeri - Admin')

@section('content')
<div class="p-6">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.gallery.index') }}" class="text-gray-600 hover:text-gray-900">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900 flex-1">Tambah Foto Galeri</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-2xl mb-6 shadow-lg">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-2xl p-8">
        @csrf
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    <i class="fas fa-image mr-2 text-blue-600"></i>Upload Foto <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-400 transition-colors cursor-pointer group">
                    <input type="file" name="image" id="image" class="hidden" required accept="image/*" onchange="previewImage(event)">
                    <label for="image" class="cursor-pointer block">
                        <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 group-hover:text-blue-500 transition-colors mb-4"></i>
                        <p class="text-lg font-semibold text-gray-700 group-hover:text-blue-600">Klik atau drag foto (JPG, PNG, max 5MB)</p>
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF | Maksimal: 5MB</p>
                    </label>
                </div>
                <div id="image-preview" class="mt-4 hidden">
                    <img id="preview-img" class="max-w-full h-64 object-cover rounded-2xl shadow-xl" alt="Preview">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Judul Foto <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('title') border-red-400 @enderror"
                       placeholder="Contoh: Upacara Bendera Hari Senin" required>

                <label class="block text-sm font-semibold text-gray-700 mb-3 mt-6">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori" class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('kategori') border-red-400 @enderror" required>
                    <option value="">Pilih kategori</option>
                    <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan Sekolah</option>
                    <option value="Prestasi" {{ old('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi Siswa</option>
                    <option value="Fasilitas" {{ old('kategori') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                    <option value="Guru" {{ old('kategori') == 'Guru' ? 'selected' : '' }}>Guru & Staf</option>
                    <option value="Siswa" {{ old('kategori') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>

                <label class="block text-sm font-semibold text-gray-700 mb-3 mt-6">
                    Deskripsi (Opsional)
                </label>
                <textarea name="description" rows="4" 
                          class="w-full px-4 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all shadow-sm @error('description') border-red-400 @enderror resize-vertical"
                          placeholder="Tulis deskripsi lengkap tentang foto ini...">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-10 pt-8 border-t border-gray-200">
            <a href="{{ route('admin.gallery.index') }}" 
               class="px-8 py-4 border border-gray-300 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 transition-all shadow-sm">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:bg-blue-700 transition-all flex items-center">
                <i class="fas fa-save mr-2"></i>Simpan Foto
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>

@endsection

