@extends('layouts.public')

@section('title', 'Daftar Siswa - SMPN 1 Pirime')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bg/smp.png') }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-950/80 via-indigo-900/75 to-emerald-900/80"></div>
        <div class="absolute inset-0 backdrop-blur-[2px]"></div>
    </div>

    <style>
        #navbar, footer, .floating-wa-global { display:none !important; }
        body { margin:0; padding:0; min-height:100vh; }

        .register-card{
            position:relative;
            z-index:10;
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.15);
            backdrop-filter:blur(18px);
            box-shadow:0 25px 50px rgba(0,0,0,.45);
        }

        .custom-input{
            background:rgba(255,255,255,.08)!important;
            border:1px solid rgba(255,255,255,.15)!important;
            color:white;
            transition:.3s;
        }

        .custom-input:focus{
            background:rgba(255,255,255,.14)!important;
            border-color:#60a5fa!important;
            box-shadow:0 0 0 4px rgba(59,130,246,.15);
        }

        .custom-input::placeholder{
            color:rgba(255,255,255,.45);
        }

        .btn-submit{
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.15);
            transition:.3s;
        }

        .btn-submit:hover{
            background:rgba(255,255,255,.14);
            transform:translateY(-2px);
        }

        .btn-login-now{
            background:linear-gradient(to right,#2563eb,#7c3aed);
            transition:.3s;
        }

        .btn-login-now:hover{
            transform:translateY(-2px);
            box-shadow:0 15px 25px rgba(37,99,235,.35);
        }

       

        .glow1,.glow2{
            position:absolute;
            border-radius:9999px;
            filter:blur(80px);
            z-index:1;
        }

        .glow1{
            width:220px;
            height:220px;
            background:#3b82f6;
            top:-60px;
            left:-80px;
            opacity:.25;
        }

        .glow2{
            width:240px;
            height:240px;
            background:#10b981;
            bottom:-80px;
            right:-80px;
            opacity:.20;
        }
    </style>

    <!-- Glow -->
    <div class="glow1"></div>
    <div class="glow2"></div>

    <!-- Register Card -->
    <div class="register-card w-full max-w-sm p-6 rounded-3xl relative">

        <div class="text-center mb-6">
            <div class="inline-block p-3 bg-white/10 rounded-2xl border border-white/15 mb-3">
                <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" class="w-12 h-12 object-cover" style="border-radius:100px;">
            </div>

            <h1 class="text-3xl font-black text-white">DAFTAR</h1>
            <p class="text-white/70 text-xs tracking-[0.25em] mt-1">SMPN 1 PIRIME</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama -->
            <div>
                <label class="text-xs text-white/80 font-bold uppercase">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="custom-input w-full px-4 py-3 rounded-xl mt-1 outline-none"
                    placeholder="Nama lengkap Anda" required>
            </div>

            <!-- Email -->
            <div>
                <label class="text-xs text-white/80 font-bold uppercase">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="custom-input w-full px-4 py-3 rounded-xl mt-1 outline-none"
                    placeholder="email@gmail.com" required>
            </div>

            <!-- Password -->
            <div class="relative">
                <label class="text-xs text-white/80 font-bold uppercase">Password</label>

                <input type="password" id="reg-password" name="password"
                    class="custom-input w-full px-4 py-3 rounded-xl mt-1 pr-10 outline-none"
                    placeholder="Min. 8 karakter" required>

                <button type="button" onclick="toggleRegPassword()" class="absolute right-3 top-10 text-white/60">
                    <i class="fas fa-eye" id="reg-eye-icon"></i>
                </button>
            </div>

            <!-- Konfirmasi -->
            <div class="relative">
                <label class="text-xs text-white/80 font-bold uppercase">Ulangi Password</label>

                <input type="password" id="reg-confirm-password" name="password_confirmation"
                    class="custom-input w-full px-4 py-3 rounded-xl mt-1 pr-10 outline-none"
                    placeholder="Ketik ulang password" required>

                <button type="button" onclick="toggleRegConfirmPassword()" class="absolute right-3 top-10 text-white/60">
                    <i class="fas fa-eye" id="reg-confirm-eye-icon"></i>
                </button>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="btn-submit w-full py-3 rounded-xl text-white font-bold">
                Buat Akun
            </button>
        </form>

        <!-- Login -->
        <div class="mt-5 pt-5 border-t border-white/10 text-center">
            <p class="text-white/50 text-xs mb-3">Sudah punya akun?</p>

            <a href="{{ route('login.form') }}"
               class="btn-login-now w-full py-3 rounded-xl text-white font-bold flex justify-center">
                Masuk Sekarang
            </a>
        </div>

    </div>

<script>
function toggleRegPassword(){
    const input = document.getElementById('reg-password');
    const icon  = document.getElementById('reg-eye-icon');

    if(input.type === 'password'){
        input.type = 'text';
        icon.classList.replace('fa-eye','fa-eye-slash');
    }else{
        input.type = 'password';
        icon.classList.replace('fa-eye-slash','fa-eye');
    }
}

function toggleRegConfirmPassword(){
    const input = document.getElementById('reg-confirm-password');
    const icon  = document.getElementById('reg-confirm-eye-icon');

    if(input.type === 'password'){
        input.type = 'text';
        icon.classList.replace('fa-eye','fa-eye-slash');
    }else{
        input.type = 'password';
        icon.classList.replace('fa-eye-slash','fa-eye');
    }
}
</script>

</div>
@endsection