<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>@yield('title', 'SMPN 1 Pirime - PPDB Online')</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#3b82f6">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo.jpg') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .glass { backdrop-filter: blur(12px); }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;\n            background-image: linear-gradient(135deg, rgba(59,130,246,0.15) 0%, rgba(147,51,234,0.15) 50%, rgba(99,102,241,0.15) 100%), url('/images/bg/smp.png');\n            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            z-index: -1;
        }
    </style>
</head>
<body class="bg-gray-50 relative">
    
    <!-- Navbar dengan Transparent Effect -->
    <nav id="navbar"
         class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-white/90 shadow-2xl border-b border-white/50 text-gray-800">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="flex items-center space-x-3 group">
<img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}"
                         alt="Logo SMPN 1 Pirime"
                         class="h-12 w-12 rounded-2xl shadow-lg group-hover:scale-110 transition-all duration-300">
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">SMPN 1 Pirime</h1>
                        <p class="text-xs font-semibold text-blue-600">PPDB Online</p>
                    </div>
                </a>
                <div class="hidden lg:flex space-x-2 items-center">
<a href="/" class="px-4 py-2 rounded-2xl font-medium hover:bg-white/50 transition-all text-gray-700 hover:text-blue-600 hover:bg-blue-50">Beranda</a>
<a href="{{ route('profil') }}" class="px-4 py-2 rounded-2xl font-medium hover:bg-white/50 transition-all text-gray-700 hover:text-blue-600 hover:bg-blue-50">Profil</a>
<a href="{{ route('pengumuman') }}" class="px-4 py-2 rounded-2xl font-medium hover:bg-white/50 transition-all text-gray-700 hover:text-blue-600 hover:bg-blue-50">Pengumuman</a>
<a href="{{ route('ppdb') }}" class="px-4 py-2 rounded-2xl font-medium hover:bg-white/50 transition-all text-gray-700 hover:text-blue-600 hover:bg-blue-50">PPDB</a>
<a href="{{ route('galeri') }}" class="px-4 py-2 rounded-2xl font-medium hover:bg-white/50 transition-all text-gray-700 hover:text-blue-600 hover:bg-blue-50">Galeri</a>
                    <a href="{{ route('login.form') }}"
                       class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-2 rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                       <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                </div>
                <button class="lg:hidden p-3 rounded-2xl shadow-lg bg-white/80 hover:bg-white text-gray-800 transition-all duration-300" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden mt-2 p-4 rounded-b-3xl bg-white/90 border-t-gray-200 space-y-3 shadow-2xl">
                <a href="/" class="block px-6 py-4 rounded-2xl font-semibold transition-all text-gray-800 hover:bg-blue-50">Beranda</a>
                <a href="{{ route('profil') }}" class="block px-6 py-4 rounded-2xl font-semibold transition-all text-gray-800 hover:bg-blue-50">Profil</a>
                <a href="{{ route('pengumuman') }}" class="block px-6 py-4 rounded-2xl font-semibold transition-all text-gray-800 hover:bg-blue-50">Pengumuman</a>
                <a href="{{ route('ppdb') }}" class="block px-6 py-4 rounded-2xl font-semibold transition-all text-gray-800 hover:bg-blue-50">PPDB</a>
                <a href="{{ route('galeri') }}" class="block px-6 py-4 rounded-2xl font-semibold transition-all text-gray-800 hover:bg-blue-50">Galeri</a>
                <a href="{{ route('login.form') }}" class="block px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl text-center shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
        </div>
    </nav>

@yield('content')

    <!-- Footer Consistent -->
    <footer class="bg-gradient-to-r from-gray-900/95 via-gray-800/95 to-black/95 backdrop-blur-xl text-white py-16 mt-20 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12">
                <div>
<img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo SMPN 1 Pirime" class="h-20 w-20 rounded-2xl mb-6 shadow-2xl border-4 border-white/20">
                    <h3 class="text-2xl font-bold mb-6 drop-shadow-lg">SMPN 1 Pirime</h3>
                    <p class="text-gray-300 leading-relaxed text-lg opacity-90 drop-shadow-md">Sekolah Negeri berkualitas dengan komitmen mencetak generasi unggul dan berakhlak mulia.</p>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-8 drop-shadow-lg">Navigasi Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="/" class="hover:text-blue-400 transition-all block py-2 text-gray-300 hover:translate-x-2">🏠 Beranda</a></li>
                        <li><a href="{{ route('profil') }}" class="hover:text-blue-400 transition-all block py-2 text-gray-300 hover:translate-x-2">👨‍🏫 Profil Sekolah</a></li>
                        <li><a href="{{ route('pengumuman') }}" class="hover:text-blue-400 transition-all block py-2 text-gray-300 hover:translate-x-2">📢 Pengumuman</a></li>
                        <li><a href="{{ route('ppdb') }}" class="hover:text-blue-400 transition-all block py-2 text-gray-300 hover:translate-x-2">📋 PPDB</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-8 drop-shadow-lg">PPDB Online</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('register.form') }}" class="hover:text-emerald-400 transition-all block py-2 text-gray-300 hover:translate-x-2">✏️ Daftar Baru</a></li>
                        <li><a href="{{ route('login.form') }}" class="hover:text-emerald-400 transition-all block py-2 text-gray-300 hover:translate-x-2">🔐 Login Siswa</a></li>
                    </ul>
                    <div class="mt-6 p-4 bg-blue-600/20 rounded-2xl backdrop-blur border border-blue-500/30">
                        <h5 class="font-bold text-lg mb-2 text-blue-200">Status PPDB</h5>
                        <p class="text-blue-100 text-sm">Buka {{ date('Y') }} / {{ date('Y') + 1 }}</p>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-8 drop-shadow-lg">Kontak Kami</h4>
                    <div class="space-y-4 text-gray-300">
                        <div class="flex items-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition-all">
                            <i class="fas fa-map-marker-alt text-2xl text-orange-400 mr-4"></i>
                            <span>Pirime, Halmahera Timur</span>
                        </div>
                        <div class="flex items-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition-all">
                            <i class="fas fa-phone text-2xl text-green-400 mr-4"></i>
                            <span>(0437) XXX XXX</span>
                        </div>
                        <div class="flex items-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition-all">
                            <i class="fas fa-envelope text-2xl text-blue-400 mr-4"></i>
                            <span>info@smpn1pirime.sch.id</span>
                        </div>
                        <a href="https://wa.me/6282120445529" class="flex items-center p-4 bg-green-500/20 hover:bg-green-500/40 rounded-2xl backdrop-blur border-2 border-green-500/30 transition-all group">
                            <i class="fab fa-whatsapp text-2xl text-green-400 mr-4 group-hover:text-green-300"></i>
                            <span class="font-bold text-lg text-green-300 group-hover:text-green-200">62 821-2044-5529</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/20 mt-16 pt-10 text-center text-gray-400 text-lg">
                &copy; {{ date('Y') }} SMPN 1 Pirime • Dibuat dengan ❤️ untuk pendidikan berkualitas
            </div>
        </div>
    </footer>

        <script>
            window.addEventListener("scroll", function(){
                const nav = document.getElementById("navbar");

                if(window.scrollY > 50){
                    nav.classList.remove("bg-transparent","text-white","border-transparent");
                    nav.classList.add("bg-white/90","shadow-2xl","text-gray-800","border-b","border-white/50");
                }
            });

            // Floating WA Button
            const waBtn = document.createElement('a');
            waBtn.href = 'https://wa.me/6282120445529?text=Halo%20Admin%20SMPN%201%20Pirime';
            waBtn.className = 'fixed bottom-8 right-8 w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-3xl shadow-2xl hover:shadow-3xl hover:scale-110 transition-all duration-300 z-40 flex items-center justify-center text-2xl border-4 border-white/20 hover:border-green-400';
            waBtn.target = '_blank';
            waBtn.innerHTML = '<i class="fab fa-whatsapp"></i>';
            document.body.appendChild(waBtn);
        </script>
    @stack('scripts')
</body>
</html>

