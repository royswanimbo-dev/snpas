// === NAVIGASI & VALIDASI ===
let currentTab = 0;
const fieldMap = {
    0: ['f_nama_lengkap','f_nik','f_jenis_kelamin','f_agama','f_tempat_lahir','f_tanggal_lahir','f_alamat','f_desa','f_kecamatan','f_kabupaten','f_provinsi'],
    1: ['f_nama_ayah','f_nama_ibu'],
    2: ['f_nama_sekolah'],
    3: []
};

function showTab(n) {
    let x = document.getElementsByClassName("wz-step");
    x[n].classList.add("active");
    
    // Atur tombol
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    
    prevBtn.classList.toggle("hidden", n == 0);
    
    if (n == x.length - 1) {
        nextBtn.innerHTML = 'Kirim Pendaftaran <i class="fas fa-paper-plane ml-2"></i>';
        nextBtn.classList.replace('bg-blue-600', 'bg-emerald-600');
        nextBtn.classList.replace('hover:bg-blue-700', 'hover:bg-emerald-700');
    } else {
        nextBtn.innerHTML = 'Lanjut <i class="fas fa-chevron-right ml-2"></i>';
        nextBtn.classList.replace('bg-emerald-600', 'bg-blue-600');
        nextBtn.classList.replace('hover:bg-emerald-700', 'hover:bg-blue-700');
    }
    
    updateStepper(n);
}

function nextPrev(n) {
    let x = document.getElementsByClassName("wz-step");
    
    // Validasi sebelum lanjut
    if (n == 1 && !validateStep(currentTab)) return false;

    x[currentTab].classList.remove("active");
    currentTab = currentTab + n;

    if (currentTab >= x.length) {
        showLoading();
        document.getElementById("wizardForm").submit();
        return false;
    }
    showTab(currentTab);
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function validateStep(n) {
    const fields = fieldMap[n] || [];
    let valid = true;
    let firstError = null;
    
    fields.forEach(id => {
        const el = document.getElementById(id);
        const err = document.getElementById('e_' + id.replace('f_',''));
        if (!el || !el.value.trim()) {
            el.classList.add('err');
            if (err) err.classList.add('show');
            valid = false;
            if (!firstError) firstError = el;
        } else {
            el.classList.remove('err');
            if (err) err.classList.remove('show');
        }
    });
    
    // Validasi khusus NIK
    if (n == 0) {
        const nik = document.getElementById('f_nik');
        if (nik && nik.value.length != 16) {
            nik.classList.add('err');
            document.getElementById('e_nik').classList.add('show');
            valid = false;
            if (!firstError) firstError = nik;
        }
    }
    
    if (firstError) {
        firstError.focus();
        firstError.scrollIntoView({behavior: 'smooth', block: 'center'});
    }
    
    return valid;
}

function updateStepper(n) {
    for (let i = 1; i <= 4; i++) {
        let dot = document.getElementById("dot" + i);
        let sn = dot.querySelector('.sn');
        let sc = dot.querySelector('.sc');
        dot.classList.remove("current", "done");
        
        if (i <= n + 1) {
            dot.classList.add("done");
            sn.classList.add('hidden');
            sc.classList.remove('hidden');
        }
        if (i == n + 1) {
            dot.classList.add("current");
            sn.classList.remove('hidden');
            sc.classList.add('hidden');
        }
        if (i > n + 1) {
            sn.classList.remove('hidden');
            sc.classList.add('hidden');
        }
    }
    let progress = (n / 3) * 100;
    document.getElementById("line-progress").style.width = progress + "%";
}

// === PREVIEW FILE UPLOAD ===
function handleFile(input) {
    const file = input.files[0];
    const box = input.closest('.file-box');
    const label = box.querySelector('.file-label');
    const icon = box.querySelector('.icon-default');
    const preview = box.querySelector('.preview-img');
    
    if (file) {
        label.textContent = file.name;
        box.classList.add('ok');
        icon.classList.add('hidden');
        
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
            icon.classList.remove('hidden');
            icon.classList = 'fas fa-file-pdf text-4xl text-red-500 mb-3';
        }
    }
}

// === LOADING OVERLAY ===
function showLoading() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) overlay.classList.add('on');
}

// Init
showTab(currentTab);

