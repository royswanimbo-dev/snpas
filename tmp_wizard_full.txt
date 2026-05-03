<?php
$content = <<<'BLADE'
@extends('layouts.app')

@section('title', 'Formulir PPDB - Siswa')

@section('custom_navbar')
<nav class="bg-white/90 backdrop-blur border-b border-slate-200 sticky top-0 z-40">
    <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-2 text-slate-700 hover:text-blue-600 transition-colors">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-md">
                <i class="fas fa-arrow-left text-white text-xs"></i>
            </div>
            <span class="font-semibold text-sm hidden sm:inline">Kembali</span>
        </a>
        <div class="flex items-center gap-3">
            <span class="px-4 py-1.5 bg-blue-50 text-blue-700 tRext-xs font-bold rounded-full border border-blue-100">
                <i class="fas fa-shield-halved mr-1"></i>Formulir PPDB 2025
            </span>
            <div class="dropdown"> 
                <button class="flex items-center gap-2 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors" data-bs-toggle="dropdown">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-xl border border-slate-100 rounded-xl mt-2 py-2 min-w-[180px]">
                    <li><a class="dropdown-item py-2" href="{{ route('siswa.dashboard') }}"><i class="fas fa-home mr-2 text-blue-500 w-4"></i>Dashboard</a></li>
                    <li><hr class="dropdown-divider mx-3"></li>
                    <li>
                        <a class="dropdown-item text-red-600 py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2 w-4"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
</nav>
@endsection

@push('styles')
<style>
    .wz-step{display:none;opacity:0;transform:translateY(20px);transition:all .5s cubic-bezier(.4,0,.2,1)}
    .wz-step.active{display:block;opacity:1;transform:translateY(0)}
    .step-dot{transition:all .4s ease}
    .step-dot.done{background:#10b981!important;border-color:#10b981!important;color:#fff!important}
    .step-dot.current{background:#3b82f6!important;border-color:#3b82f6!important;color:#fff!important;box-shadow:0 0 0 5px rgba(59,130,246,.2)}
    .line-fill{transition:width .6s ease}
    .inp:focus{box-shadow:0 0 0 4px rgba(59,130,246,.12);border-color:#3b82f6}
    .inp.err{border-color:#ef4444;box-shadow:0 0 0 4px rgba(239,68,68,.12)}
    .hero-pattern{background:linear-gradient(135deg,#dbeafe 0%,#e0e7ff 100%)}
    .file-box{border:2px dashed #cbd5e1;transition:all .3s ease;cursor:pointer}
    .file-box:hover{border-color:#3b82f6;background:#eff6ff}
    .file-box.ok{border-color:#10b981;background:#ecfdf5}
    .fmsg{color:#ef4444;font-size:.75rem;margin-top:.25rem;display:none}
    .fmsg.show{display:block}
    .overlay{position:fixed;inset:0;background:rgba(255,255,255,.9);backdrop-filter:blur(4px);z-index:9999;display:none;align-items:center;justify-content:center;flex-direction:column}
    .overlay.on{display:flex}
    .spin{width:50px;height:50px;border:4px solid #dbeafe;border-top-color:#3b82f6;border-radius:50%;animation:spin 1s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}
</style>
@endpush

@section('content')
<div class="min-h-screen hero-pattern pb-20">
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white">
        <div class="max-w-6xl mx-auto px-4 py-10 relative z-10 text-center">
            <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-clipboard-check text-3xl text-white"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2">Formulir Pendaftaran PPDB</h1>
            <p class="text-blue-100 text-sm md:text-base max-w-lg mx-auto">Lengkapi data pendaftaran SMP Negeri Pirime dengan teliti.</p>
        </div>

    <div class="max-w-6xl mx-auto px-4 -mt-6 relative z-20">
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

        <!-- Stepper -->
        <div class="bg-white/80 backdrop-blur rounded-3xl shadow-lg p-6 mb-8">
            <div class="flex items-center justify-between relative">
                @php $labels=['Data Diri','Orang Tua','Sekolah','Berkas']; @endphp
                @foreach($labels as $i=>$lbl)
                    @php $num=$i+1; @endphp
                    <div class="flex flex-col items-center relative z-10" style="width:25%">
                        <div id="dot{{$num}}" class="step-dot w-12 h-12 rounded-full border-4 border-slate-200 bg-white text-slate-400 flex items-center justify-center font-bold mb-2">
                            <span class="sn">{{$num}}</span>
                            <i class="fas fa-check sc hidden"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-500 uppercase">{{$lbl}}</span>
                    </div>
                @endforeach
                <div class="absolute top-6 left-0 w-full h-1 bg-slate-200 -z-0">
                    <div id="line-progress" class="line-fill h-full bg-blue-500" style="width:0%"></div>
            </div>

        <form id="wizardForm" action="{{ route('siswa.pendaftaran.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- STEP 1: DATA DIRI -->
            <div id="step1" class="wz-step active">
                <div class="bg-white rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-4 flex items-center gap-2"><i class="fas fa-user-circle text-blue-600"></i>Data Pribadi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" id="f_nama_lengkap" value="{{ old('nama_lengkap',$pendaftar->nama_lengkap??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Sesuai KK">
                            <p class="fmsg" id="e_nama_lengkap">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" id="f_nik" value="{{ old('nik',$pendaftar->nik??'') }}" required maxlength="16" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="16 digit NIK" oninput="this.value=this.value.replace(/\D/g,'')">
                            <p class="fmsg" id="e_nik">Wajib 16 digit angka</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn',$pendaftar->nisn??'') }}" maxlength="10" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="10 digit NISN" oninput="this.value=this.value.replace(/\D/g,'')">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" id="f_jenis_kelamin" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none bg-white">
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin',$pendaftar->jenis_kelamin??'')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin',$pendaftar->jenis_kelamin??'')=='Perempuan'?'selected':'' }}>Perempuan</option>
                            </select>
                            <p class="fmsg" id="e_jenis_kelamin">Pilih jenis kelamin</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Agama <span class="text-red-500">*</span></label>
                            <select name="agama" id="f_agama" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none bg-white">
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama',$pendaftar->agama??'')=='Islam'?'selected':'' }}>Islam</option>
                                <option value="Kristen" {{ old('agama',$pendaftar->agama??'')=='Kristen'?'selected':'' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama',$pendaftar->agama??'')=='Katolik'?'selected':'' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama',$pendaftar->agama??'')=='Hindu'?'selected':'' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama',$pendaftar->agama??'')=='Buddha'?'selected':'' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama',$pendaftar->agama??'')=='Konghucu'?'selected':'' }}>Konghucu</option>
                            </select>
                            <p class="fmsg" id="e_agama">Pilih agama</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">No. HP Siswa</label>
                            <input type="text" name="no_hp_siswa" value="{{ old('no_hp_siswa',$pendaftar->no_hp_siswa??'') }}" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="08xxxxxxxxxx" oninput="this.value=this.value.replace(/\D/g,'')">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" id="f_tempat_lahir" value="{{ old('tempat_lahir',$pendaftar->tempat_lahir??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Kota/Kabupaten">
                            <p class="fmsg" id="e_tempat_lahir">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" id="f_tanggal_lahir" value="{{ old('tanggal_lahir',isset($pendaftar->tanggal_lahir)?$pendaftar->tanggal_lahir->format('Y-m-d'):'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none">
                            <p class="fmsg" id="e_tanggal_lahir">Pilih tanggal lahir</p>
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" id="f_alamat" rows="3" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Alamat lengkap sesuai KK">{{ old('alamat',$pendaftar->alamat??'') }}</textarea>
                            <p class="fmsg" id="e_alamat">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Desa/Kelurahan <span class="text-red-500">*</span></label>
                            <input type="text" name="desa" id="f_desa" value="{{ old('desa',$pendaftar->desa??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Desa/Kelurahan">
                            <p class="fmsg" id="e_desa">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Kecamatan <span class="text-red-500">*</span></label>
                            <input type="text" name="kecamatan" id="f_kecamatan" value="{{ old('kecamatan',$pendaftar->kecamatan??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Kecamatan">
                            <p class="fmsg" id="e_kecamatan">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <input type="text" name="kabupaten" id="f_kabupaten" value="{{ old('kabupaten',$pendaftar->kabupaten??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Kabupaten/Kota">
                            <p class="fmsg" id="e_kabupaten">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Provinsi <span class="text-red-500">*</span></label>
                            <input type="text" name="provinsi" id="f_provinsi" value="{{ old('provinsi',$pendaftar->provinsi??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Provinsi">
                            <p class="fmsg" id="e_provinsi">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Anak Ke-</label>
                            <input type="number" name="anak_ke" value="{{ old('anak_ke',$pendaftar->anak_ke??'') }}" min="1" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="1,2,3...">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Jumlah Saudara</label>
                            <input type="number" name="jumlah_saudara" value="{{ old('jumlah_saudara',$pendaftar->jumlah_saudara??'') }}" min="0" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="0,1,2...">
                        </div>
                </div>

            <!-- STEP 2: ORANG TUA -->
            <div id="step2" class="wz-step">
                <div class="bg-white rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-4 flex items-center gap-2"><i class="fas fa-users text-emerald-600"></i>Data Orang Tua</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Ayah -->
                        <div class="bg-blue-50/30 p-6 rounded-2xl border border-blue-100 space-y-4">
                            <label class="block font-bold text-blue-800 text-lg mb-3 flex items-center gap-2"><i class="fas fa-male text-blue-500"></i>Data Ayah</label>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">Nama Ayah <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ayah" id="f_nama_ayah" value="{{ old('nama_ayah',$pendaftar->nama_ayah??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Nama lengkap ayah">
                                <p class="fmsg" id="e_nama_ayah">Wajib diisi</p>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">Pendidikan Ayah</label>
                                <select name="pendidikan_ayah" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none bg-white">
                                    <option value="">Pilih Pendidikan</option>
                                    @php $opts=['SD/Sederajat','SMP/Sederajat','SMA/Sederajat','D1/D2','D3','S1','S2','S3']; @endphp
                                    @foreach($opts as $o)<option value="{{$o}}" {{ old('pendidikan_ayah',$pendaftar->pendidikan_ayah??'')==$o?'selected':'' }}>{{$o}}</option>@endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah',$pendaftar->pekerjaan_ayah??'') }}" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Contoh: Petani, PNS, Wiraswasta">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">No. HP Ayah</label>
                                <input type="text" name="no_hp_ayah" value="{{ old('no_hp_ayah',$pendaftar->no_hp_ayah??'') }}" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="08xxxxxxxxxx" oninput="this.value=this.value.replace(/\D/g,'')">
                            </div>
                        <!-- Ibu -->
                        <div class="bg-pink-50/30 p-6 rounded-2xl border border-pink-100 space-y-4">
                            <label class="block font-bold text-pink-800 text-lg mb-3 flex items-center gap-2"><i class="fas fa-female text-pink-500"></i>Data Ibu</label>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">Nama Ibu <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_ibu" id="f_nama_ibu" value="{{ old('nama_ibu',$pendaftar->nama_ibu??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Nama lengkap ibu">
                                <p class="fmsg" id="e_nama_ibu">Wajib diisi</p>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">Pendidikan Ibu</label>
                                <select name="pendidikan_ibu" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none bg-white">
                                    <option value="">Pilih Pendidikan</option>
                                    @foreach($opts as $o)<option value="{{$o}}" {{ old('pendidikan_ibu',$pendaftar->pendidikan_ibu??'')==$o?'selected':'' }}>{{$o}}</option>@endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu',$pendaftar->pekerjaan_ibu??'') }}" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Contoh: Ibu Rumah Tangga, Guru">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-slate-700">No. HP Ibu</label>
                                <input type="text" name="no_hp_ibu" value="{{ old('no_hp_ibu',$pendaftar->no_hp_ibu??'') }}" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="08xxxxxxxxxx" oninput="this.value=this.value.replace(/\D/g,'')">
                            </div>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-slate-700">Penghasilan Orang Tua</label>
                        <select name="penghasilan_orangtua" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none bg-white">
                            <option value="">Pilih Rentang Penghasilan</option>
                            @php $ph=['< Rp 1.000.000','Rp 1.000.000 - Rp 3.000.000','Rp 3.000.000 - Rp 5.000.000','> Rp 5.000.000']; @endphp
                            @foreach($ph as $p)<option value="{{$p}}" {{ old('penghasilan_orangtua',$pendaftar->penghasilan_orangtua??'')==$p?'selected':'' }}>{{$p}}</option>@endforeach
                        </select>
                    </div>
            </div>

            <!-- STEP 3: SEKOLAH -->
            <div id="step3" class="wz-step">
                <div class="bg-white rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-4 flex items-center gap-2"><i class="fas fa-school text-violet-600"></i>Asal Sekolah</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">Nama SD/MI Asal <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_sekolah" id="f_nama_sekolah" value="{{ old('nama_sekolah',$pendaftar->nama_sekolah??'') }}" required class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Contoh: SD Negeri 1 Jayapura">
                            <p class="fmsg" id="e_nama_sekolah">Wajib diisi</p>
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-slate-700">NPSN</label>
                            <input type="text" name="npsn" value="{{ old('npsn',$pendaftar->npsn??'') }}" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="8 digit NPSN" maxlength="8" oninput="this.value=this.value.replace(/\D/g,'')">
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700">Alamat Sekolah</label>
                            <textarea name="alamat_sekolah" rows="3" class="inp w-full px-5 py-3 border border-slate-300 rounded-2xl outline-none" placeholder="Alamat sekolah asal">{{ old('alamat_sekolah',$pendaftar->alamat_sekolah??'') }}</textarea>
                        </div>
                </div>

            <!-- STEP 4: BERKAS -->
            <div id="step4" class="wz-step">
                <div class="bg-white rounded-3xl shadow-sm p-6 sm:p-10 space-y-6">
                    <h2 class="text-xl font-bold text-slate-800 border-b pb-4 flex items-center gap-2"><i class="fas fa-file-upload text-amber-600"></i>Unggah Dokumen</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Foto Profil -->
                        <div class="file-box rounded-2xl p-8 text-center" onclick="document.getElementById('foto_profil').click()">
                            <img id="pv_foto_profil" class="preview-img mx-auto hidden" />
                            <input type="file" name="foto_profil" id="foto_profil" class="hidden" accept="image/*" onchange="handleFile(this)">
                            <i class="fas fa-camera text-4xl text-slate-300 mb-3 icon-default"></i>
                            <p class="text-sm font-bold text-slate-600 file-label">Klik untuk Upload Foto Profil</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG (Max 2MB)</p>
                        </div>
                        <!-- Foto -->
                        <div class="file-box rounded-2xl p-8 text-center" onclick="document.getElementById('foto').click()">
                            <img id="pv_foto" class="preview-img mx-auto hidden" />
                            <input type="file" name="foto" id="foto" class="hidden" accept="image/*" onchange="handleFile(this)">
                            <i class="fas fa-image text-4xl text-slate-300 mb-3 icon-default"></i>
                            <p class="text-sm font-bold text-slate-600 file-label">Klik untuk Upload Foto</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG (Max 2MB)</p>
                        </div>
                        <!-- KK -->
                        <div class="file-box rounded-2xl p-8 text-center" onclick="document.getElementById('kk').click()">
                            <img id="pv_kk" class="preview-img mx-auto hidden" />
                            <input type="file" name="kk" id="kk" class="hidden" accept="image/*,application/pdf" onchange="handleFile(this)">
                            <i class="fas fa-address-card text-4xl text-slate-300 mb-3 icon-default"></i>
                            <p class="text-sm font-bold text-slate-600 file-label">Klik untuk Upload KK</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, PDF (Max 5MB)</p>
                        </div>
                        <!-- Akte -->
                        <div class="file-box rounded-2xl p-8 text-center" onclick="document.getElementById('akte').click()">
                            <img id="pv_akte" class="preview-img mx-auto hidden" />
                            <input type="file" name="akte" id="akte" class="hidden" accept="image/*,application/pdf" onchange="handleFile(this)">
                            <i class="fas fa-file-alt text-4xl text-slate-300 mb-3 icon-default"></i>
                            <p class="text-sm font-bold text-slate-600 file-label">Klik untuk Upload Akte Kelahiran</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, PDF (Max 5MB)</p>
                        </div>
                        <!-- Ijazah -->
                        <div class="file-box rounded-2xl p-8 text-center" onclick="document.getElementById('ijazah').click()">
                            <img id="pv_ijazah" class="preview-img mx-auto hidden" />
                            <input type="file" name="ijazah" id="ijazah" class="hidden" accept="image/*,application/pdf" onchange="handleFile(this)">
                            <i class="fas fa-graduation-cap text-4xl text-slate-300 mb-3 icon-default"></i>
                            <p class="text-sm font-bold text-slate-600 file-label">Klik untuk Upload Ijazah/SKL</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, PDF (Max 5MB)</p>
                        </div>
                        <!-- Kartu NISN -->
                        <div class="file-box rounded-2xl p-8 text-center" onclick="document.getElementById('kartu_nisn').click()">
                            <img id="pv_kartu_nisn" class="preview-img mx-auto hidden" />
                            <input type="file" name="kartu_nisn" id="kartu_nisn" class="hidden" accept="image/*,application/pdf" onchange="handleFile(this)">
                            <i class="fas fa-id-card text-4xl text-slate-300 mb-3 icon-default"></i>
                            <p class="text-sm font-bold text-slate-600 file-label">Klik untuk Upload Kartu NISN</p>
                            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, PDF (Max 5MB)</p>
                        </div>
                </div>

            <!-- NAVIGATION BUTTONS -->
            <div class="flex justify-between items-center mt-10">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="px-8 py-3.5 bg-white text-slate-600 font-bold rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all hidden">
                    <i class="fas fa-chevron-left mr-2"></i>Kembali
                </button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)" class="ml-auto px-10 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg hover:bg-blue-700 transition-all">
                    Lanjut<i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>

<!-- 