@extends('layouts.app')

@section('title','Formulir PPDB - Siswa')

@push('styles')
<style>
/* ===============================
   PREMIUM PPDB WIZARD UI
=================================*/
html{scroll-behavior:smooth}
body{
    background: linear-gradient(135deg,#eff6ff,#eef2ff,#f8fafc);
}

/* dark mode */
body.dark{
    background: linear-gradient(135deg,#0f172a,#111827,#1e293b);
}

/* glass */
.glass{
    background: rgba(255,255,255,.75);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border:1px solid rgba(255,255,255,.4);
    box-shadow:0 20px 45px rgba(15,23,42,.08);
}
body.dark .glass{
    background: rgba(15,23,42,.82);
    border:1px solid rgba(255,255,255,.06);
    color:#e2e8f0;
}

/* step */
.step-circle{
    width:46px;height:46px;border-radius:999px;
    display:flex;align-items:center;justify-content:center;
    font-weight:700;
    transition:.35s ease;
}
.step-default{
    background:#e2e8f0;color:#64748b;
}
.step-active{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    transform:scale(1.08);
    box-shadow:0 10px 20px rgba(37,99,235,.25);
}
.step-done{
    background:linear-gradient(135deg,#10b981,#059669);
    color:#fff;
}

/* progress */
.progress-wrap{
    height:10px;
    border-radius:999px;
    overflow:hidden;
    background:#e5e7eb;
}
.progress-bar{
    height:100%;
    width:20%;
    transition:.4s ease;
    background:linear-gradient(90deg,#2563eb,#4f46e5,#10b981);
}

/* input */
.input{
    width:100%;
    border:1.5px solid #dbeafe;
    border-radius:16px;
    padding:.8rem 1rem;
    outline:none;
    transition:.25s ease;
    background:#fff;
}
.input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 4px rgba(37,99,235,.1);
}
.input.error{
    border-color:#ef4444!important;
    box-shadow:0 0 0 4px rgba(239,68,68,.08);
}
body.dark .input{
    background:#0f172a;
    border-color:#334155;
    color:#e2e8f0;
}

/* panels */
.step-panel{display:none;animation:fade .35s ease}
.step-panel.active{display:block}
@keyframes fade{
    from{opacity:0;transform:translateY(12px)}
    to{opacity:1;transform:translateY(0)}
}

/* buttons */
.btn{
    border-radius:18px;
    padding:.85rem 1.2rem;
    font-weight:700;
    transition:.25s ease;
}
.btn:hover{transform:translateY(-2px)}
.btn-primary{
    color:#fff;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
}
.btn-success{
    color:#fff;
    background:linear-gradient(135deg,#10b981,#059669);
}
.btn-light{
    background:#f1f5f9;
}
body.dark .btn-light{
    background:#1e293b;color:#fff;
}

/* upload */
.upload-box{
    border:2px dashed #93c5fd;
    border-radius:20px;
    padding:22px;
    text-align:center;
    cursor:pointer;
}
.preview{
    margin-top:10px;
    max-height:130px;
    border-radius:14px;
    object-fit:cover;
}

/* toast */
.toast{
    position:fixed;
    top:20px;right:20px;
    z-index:9999;
    min-width:280px;
    transform:translateX(150%);
    transition:.35s ease;
}
.toast.show{transform:translateX(0)}

/* spinner */
.spin{
    width:18px;height:18px;
    border:2px solid rgba(255,255,255,.4);
    border-top-color:#fff;
    border-radius:999px;
    animation:spin .7s linear infinite;
}
@keyframes spin{to{transform:rotate(360deg)}}
</style>
@endpush


@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    <!-- TOAST -->
    <div id="toast" class="toast">
        <div class="glass rounded-2xl px-5 py-4 flex items-center gap-3">
            <i class="fas fa-circle-exclamation text-red-500 text-lg"></i>
            <div>
                <div class="font-bold text-sm">Perhatian</div>
                <div id="toastText" class="text-xs text-slate-500">Lengkapi data.</div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <div class="glass rounded-3xl p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
            <div>
                <h1 class="text-2xl md:text-3xl font-black text-slate-800 dark:text-white">
                    Formulir PPDB Online
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Sistem Pendaftaran Siswa Baru Premium
                </p>
            </div>

            <button onclick="toggleDarkMode()" class="btn btn-light">
                <i class="fas fa-moon mr-2"></i>Dark Mode
            </button>
        </div>

        <!-- progress -->
        <div class="mt-6">
            <div class="progress-wrap">
                <div class="progress-bar" id="progressBar"></div>
            </div>
            <div class="text-xs mt-2 font-semibold text-slate-500" id="progressText">
                Step 1 dari 5
            </div>
        </div>

        <!-- steps -->
        <div class="grid grid-cols-5 gap-2 mt-6 text-center">
            <div>
                <div id="icon1" class="step-circle step-active mx-auto">
                    <i class="fas fa-user"></i>
                </div>
                <div class="text-xs mt-2 font-semibold">Pribadi</div>
            </div>

            <div>
                <div id="icon2" class="step-circle step-default mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <div class="text-xs mt-2 font-semibold">Ortu</div>
            </div>

            <div>
                <div id="icon3" class="step-circle step-default mx-auto">
                    <i class="fas fa-school"></i>
                </div>
                <div class="text-xs mt-2 font-semibold">Sekolah</div>
            </div>

            <div>
                <div id="icon4" class="step-circle step-default mx-auto">
                    <i class="fas fa-file-arrow-up"></i>
                </div>
                <div class="text-xs mt-2 font-semibold">Berkas</div>
            </div>

            <div>
                <div id="icon5" class="step-circle step-default mx-auto">
                    <i class="fas fa-check"></i>
                </div>
                <div class="text-xs mt-2 font-semibold">Review</div>
            </div>
        </div>
    </div>

    <!-- FORM -->
    <form method="POST"
          action="{{ route('siswa.pendaftaran.simpan') }}"
          enctype="multipart/form-data"
          id="ppdbForm"
          onsubmit="return handleSubmit(event)">
        @csrf

        <!-- STEP 1 -->
        <div class="step-panel active glass rounded-3xl p-6" id="step1">
            <h2 class="font-black text-xl mb-6">Data Pribadi</h2>

            <div class="grid md:grid-cols-3 gap-4">
                <input class="input required-field" name="nama_lengkap" placeholder="Nama Lengkap">
                <input class="input required-field" name="nik" placeholder="NIK">
                <input class="input" name="nisn" placeholder="NISN">

                <select class="input required-field" name="jenis_kelamin">
                    <option value="">Jenis Kelamin</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>

                <input class="input required-field" name="tempat_lahir" placeholder="Tempat Lahir">
                <input type="date" class="input required-field" name="tanggal_lahir">

                <input class="input required-field" name="agama" placeholder="Agama">
                <input class="input" name="no_hp" placeholder="No HP">
                <input class="input required-field" name="desa" placeholder="Desa">

                <input class="input required-field" name="kecamatan" placeholder="Kecamatan">
                <input class="input required-field" name="kabupaten" placeholder="Kabupaten">
                <input class="input required-field" name="provinsi" placeholder="Provinsi">

                <input class="input" name="anak_ke" placeholder="Anak Ke">
                <input class="input" name="jumlah_saudara" placeholder="Jumlah Saudara">

                <textarea class="input md:col-span-3 required-field"
                    name="alamat"
                    rows="3"
                    placeholder="Alamat Lengkap"></textarea>
            </div>
        </div>

        <!-- STEP 2 -->
        <div class="step-panel glass rounded-3xl p-6" id="step2">
            <h2 class="font-black text-xl mb-6">Data Orang Tua</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <input class="input required-field" name="nama_ayah" placeholder="Nama Ayah">
                <input class="input" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">

                <input class="input" name="pendidikan_ayah" placeholder="Pendidikan Ayah">
                <input class="input" name="hp_ayah" placeholder="HP Ayah">

                <input class="input required-field" name="nama_ibu" placeholder="Nama Ibu">
                <input class="input" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">

                <input class="input" name="pendidikan_ibu" placeholder="Pendidikan Ibu">
                <input class="input" name="hp_ibu" placeholder="HP Ibu">

                <input class="input" name="penghasilan" placeholder="Penghasilan Orang Tua">
                <textarea class="input md:col-span-2"
                    name="alamat_ortu"
                    rows="3"
                    placeholder="Alamat Orang Tua"></textarea>
            </div>
        </div>

        <!-- STEP 3 -->
        <div class="step-panel glass rounded-3xl p-6" id="step3">
            <h2 class="font-black text-xl mb-6">Data Sekolah Asal</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <input class="input required-field" name="nama_sekolah" placeholder="Nama Sekolah">
                <input class="input" name="npsn" placeholder="NPSN">
                <input class="input" name="alamat_sekolah" placeholder="Alamat Sekolah">
                <input class="input" name="tahun_lulus" placeholder="Tahun Lulus">
                <input class="input" name="no_ijazah" placeholder="Nomor Ijazah">
                <input class="input" name="nilai_rata" placeholder="Nilai Rata-rata">
            </div>
        </div>

        <!-- STEP 4 -->
        <div class="step-panel glass rounded-3xl p-6" id="step4">
            <h2 class="font-black text-xl mb-6">Upload Berkas</h2>

            <div class="grid md:grid-cols-2 gap-4">

                <div class="upload-box">
                    <label>Foto</label>
                    <input type="file" name="foto" accept="image/*"
                           onchange="previewUpload(this,'prev1')">
                    <img id="prev1" class="preview hidden">
                </div>

                <div class="upload-box">
                    <label>KK</label>
                    <input type="file" name="kk"
                           onchange="previewUpload(this,'prev2')">
                    <img id="prev2" class="preview hidden">
                </div>

                <div class="upload-box">
                    <label>Akta Lahir</label>
                    <input type="file" name="akta"
                           onchange="previewUpload(this,'prev3')">
                    <img id="prev3" class="preview hidden">
                </div>

                <div class="upload-box">
                    <label>Ijazah / SKL</label>
                    <input type="file" name="ijazah"
                           onchange="previewUpload(this,'prev4')">
                    <img id="prev4" class="preview hidden">
                </div>

            </div>
        </div>

        <!-- STEP 5 -->
        <div class="step-panel glass rounded-3xl p-6" id="step5">
            <h2 class="font-black text-xl mb-6">Review Data</h2>

            <div id="reviewArea"
                 class="grid md:grid-cols-2 gap-3 text-sm">
            </div>
        </div>

        <!-- BUTTON -->
        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-between">
            <button type="button"
                    onclick="prevStep()"
                    id="prevBtn"
                    class="btn btn-light hidden">
                <i class="fas fa-arrow-left mr-2"></i>Previous
            </button>

            <div class="ml-auto flex gap-3">
                <button type="button"
                        onclick="saveDraftLocalStorage()"
                        class="btn btn-light">
                    <i class="fas fa-floppy-disk mr-2"></i>Simpan Draft
                </button>

                <button type="button"
                        onclick="nextStep()"
                        id="nextBtn"
                        class="btn btn-primary">
                    Next <i class="fas fa-arrow-right ml-2"></i>
                </button>

                <button type="submit"
                        id="submitBtn"
                        class="btn btn-success hidden">
                    <span id="submitText">
                        Submit Final
                    </span>
                    <span id="submitLoading"
                          class="hidden items-center gap-2">
                        <span class="spin"></span>Loading...
                    </span>
                </button>
            </div>
        </div>

    </form>
</div>
@endsection


@push('scripts')
<script>
let currentStep = 1;
const totalSteps = 5;

/* NEXT */
function nextStep(){
    if(!validateStep()) return;

    if(currentStep < totalSteps){
        currentStep++;
        showStep();
    }
}

/* PREV */
function prevStep(){
    if(currentStep > 1){
        currentStep--;
        showStep();
    }
}

/* SHOW STEP */
function showStep(){
    document.querySelectorAll('.step-panel').forEach(el=>{
        el.classList.remove('active');
    });

    document.getElementById('step'+currentStep).classList.add('active');

    updateProgress();

    document.getElementById('prevBtn')
        .classList.toggle('hidden', currentStep===1);

    document.getElementById('nextBtn')
        .classList.toggle('hidden', currentStep===5);

    document.getElementById('submitBtn')
        .classList.toggle('hidden', currentStep!==5);

    if(currentStep===5){
        generateReview();
    }

    window.scrollTo({top:0,behavior:'smooth'});
}

/* PROGRESS */
function updateProgress(){
    let percent = (currentStep/totalSteps)*100;
    document.getElementById('progressBar').style.width = percent+'%';
    document.getElementById('progressText').innerText =
        'Step '+currentStep+' dari '+totalSteps;

    for(let i=1;i<=5;i++){
        let icon = document.getElementById('icon'+i);
        icon.className = 'step-circle mx-auto';

        if(i < currentStep){
            icon.classList.add('step-done');
        }else if(i === currentStep){
            icon.classList.add('step-active');
        }else{
            icon.classList.add('step-default');
        }
    }
}

/* VALIDATE */
function validateStep(){
    let panel = document.getElementById('step'+currentStep);
    let fields = panel.querySelectorAll('.required-field');

    let valid = true;

    fields.forEach(f=>{
        f.classList.remove('error');

        if(f.value.trim()===''){
            f.classList.add('error');
            valid = false;
        }
    });

    if(!valid){
        showToast('Lengkapi semua data wajib dahulu.');
    }

    return valid;
}

/* REVIEW */
function generateReview(){
    let area = document.getElementById('reviewArea');
    area.innerHTML = '';

    let data = new FormData(document.getElementById('ppdbForm'));

    data.forEach((value,key)=>{
        if(value && typeof value === 'string'){
            area.innerHTML += `
                <div class="glass rounded-2xl p-3">
                    <div class="text-xs text-slate-500 mb-1">${key}</div>
                    <div class="font-bold">${value}</div>
                </div>
            `;
        }
    });
}

/* PREVIEW */
function previewUpload(input,target){
    const file = input.files[0];
    if(!file) return;

    const reader = new FileReader();
    reader.onload = function(e){
        const img = document.getElementById(target);
        img.src = e.target.result;
        img.classList.remove('hidden');
    }
    reader.readAsDataURL(file);
}

/* DARK MODE */
function toggleDarkMode(){
    document.body.classList.toggle('dark');
    localStorage.setItem(
        'darkMode',
        document.body.classList.contains('dark')
    );
}

/* SUBMIT */
function handleSubmit(e){
    if(!validateStep()){
        e.preventDefault();
        return false;
    }

    document.getElementById('submitText').classList.add('hidden');
    document.getElementById('submitLoading').classList.remove('hidden');

    return true;
}

/* SAVE DRAFT */
function saveDraftLocalStorage(){
    const form = document.getElementById('ppdbForm');
    const data = {};

    [...form.elements].forEach(el=>{
        if(el.name && el.type!=='file'){
            data[el.name] = el.value;
        }
    });

    localStorage.setItem('ppdbDraft', JSON.stringify(data));
    showToast('Draft berhasil disimpan.');
}

/* LOAD DRAFT */
function loadDraftLocalStorage(){
    let data = localStorage.getItem('ppdbDraft');
    if(!data) return;

    data = JSON.parse(data);

    Object.keys(data).forEach(key=>{
        let el = document.querySelector(`[name="${key}"]`);
        if(el) el.value = data[key];
    });
}

/* TOAST */
function showToast(msg){
    document.getElementById('toastText').innerText = msg;
    const toast = document.getElementById('toast');
    toast.classList.add('show');

    setTimeout(()=>{
        toast.classList.remove('show');
    },3000);
}

/* INIT */
window.onload = function(){
    loadDraftLocalStorage();

    if(localStorage.getItem('darkMode')==='true'){
        document.body.classList.add('dark');
    }

    updateProgress();
}
</script>
@endpush