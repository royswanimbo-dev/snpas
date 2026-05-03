@extends('layouts.app')

@section('title', 'Formulir PPDB - Siswa')

@section('custom_navbar')
<nav class="bg-white/90 backdrop-blur border-b border-slate-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2 text-slate-700 hover:text-blue-600 transition-colors">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-md">
                <i class="fas fa-arrow-left text-white text-xs"></i>
            </div>
            <span class="font-semibold text-sm hidden sm:inline">Kembali</span>
        </a>
        <div class="flex items-center gap-3">
            <span class="px-4 py-1.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-full border border-blue-100">
                <i class="fas fa-shield-halved mr-1"></i>Formulir PPDB 2025
            </span>
        </div>
</nav>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 pb-20">

    <!-- Header -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10 relative z-10 text-center">
            <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-clipboard-check text-3xl text-white"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Formulir Pendaftaran PPDB</h1>
            <p class="text-blue-100 text-sm md:text-base max-w-lg mx-auto">Lengkapi data pendaftaran SMP Negeri Pirime dengan teliti.</p>
        </div>

    <div class="max-w-7xl mx-auto px-4 -mt-6 relative z-20">

        @if(session('sukses'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5 mb-6 flex items-center gap-4 shadow-sm">
            <i class="fas fa-check-circle text-emerald-600 text-xl"></i>
            <div>
                <p class="text-emerald-800 font-bold">Berhasil!</p>
                <p class="text-emerald-600">{{ session('sukses') }}</p>
            </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-5 mb-6 shadow-sm">
            <div class="flex items-start gap-4">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                <div>
                    <p class="text-red-800 font-bold">Terjadi kesalahan</p>
                    <ul class="text-red-600 text-sm list-disc list-inside">
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
        </div>
        @endif

        <form action="{{ route('siswa.pendaftaran.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- DATA DIRI -->
            <div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8 mb-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i class="fas fa-user-circle text-blue-600"></i>Data Pribadi
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap',$pendaftar->nama_lengkap??'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Sesuai KK">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik',$pendaftar->nik??'') }}" required maxlength="16" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="16 digit NIK" oninput="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">NISN</label>
                        <input type="text" name="nisn" value="{{ old('nisn',$pendaftar->nisn??'') }}" maxlength="10" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="10 digit NISN" oninput="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin',$pendaftar->jenis_kelamin??'')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin',$pendaftar->jenis_kelamin??'')=='Perempuan'?'selected':'' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Agama <span class="text-red-500">*</span></label>
                        <select name="agama" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama',$pendaftar->agama??'')=='Islam'?'selected':'' }}>Islam</option>
                            <option value="Kristen" {{ old('agama',$pendaftar->agama??'')=='Kristen'?'selected':'' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama',$pendaftar->agama??'')=='Katolik'?'selected':'' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama',$pendaftar->agama??'')=='Hindu'?'selected':'' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama',$pendaftar->agama??'')=='Buddha'?'selected':'' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama',$pendaftar->agama??'')=='Konghucu'?'selected':'' }}>Konghucu</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">No. HP Siswa</label>
                        <input type="text" name="no_hp_siswa" value="{{ old('no_hp_siswa',$pendaftar->no_hp_siswa??'') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="08xxxxxxxxxx" oninput="this.value=this.value.replace(/\D/g,'')">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir',$pendaftar->tempat_lahir??'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Kota/Kabupaten">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir',isset($pendaftar->tanggal_lahir)?$pendaftar->tanggal_lahir->format('Y-m-d'):'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-sm font-bold text-slate-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="2" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Alamat lengkap sesuai KK">{{ old('alamat',$pendaftar->alamat??'') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Desa/Kelurahan <span class="text-red-500">*</span></label>
                        <input type="text" name="desa" value="{{ old('desa',$pendaftar->desa??'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Desa/Kelurahan">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan',$pendaftar->kecamatan??'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Kecamatan">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Kabupaten/Kota <span class="text-red-500">*</span></label>
                        <input type="text" name="kabupaten" value="{{ old('kabupaten',$pendaftar->kabupaten??'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Kabupaten/Kota">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Provinsi <span class="text-red-500">*</span></label>
                        <input type="text" name="provinsi" value="{{ old('provinsi',$pendaftar->provinsi??'') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Provinsi">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Anak Ke-</label>
                        <input type="number" name="anak_ke" value="{{ old('anak_ke',$pendaftar->anak_ke??'') }}" min="1" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="1,2,3...">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Jumlah Saudara</label>
                        <input type="number" name="jumlah_saudara" value="{{ old('jumlah_saudara',$pendaftar->jumlah_saudara??'') }}" min="0" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="0,1,2...">
                    </div>
            </div>

            <!-- DATA ORANG TUA -->
            <div class="bg-white rounded-2xl shadow-sm p-6 sm:p-8 mb-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i class="fas fa-users text-emerald-600"></i>Data Orang Tua
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h3 class="font-bold text-blue-800 flex items-center gap-2"><i class="fas fa-male text-blue-500"></i>Ayah</h3>

