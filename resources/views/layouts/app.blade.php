<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMPN 1 Pirime - PPDB Online')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f1f5f9; }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .glass-dark {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .navbar-glass {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.95) 0%, rgba(49, 46, 129, 0.95) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .sidebar-admin {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        }
        .sidebar-student {
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 50%, #312e81 100%);
        }

        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        .sidebar-link:hover::before,
        .sidebar-link.active::before {
            transform: scaleY(1);
        }
        .sidebar-link:hover {
            transform: translateX(4px);
            background: rgba(255,255,255,0.08);
        }
        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
            border-right: 2px solid #3b82f6;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .submenu.open {
            max-height: 500px;
        }
        .chevron { transition: transform 0.3s ease; }
        .chevron.rotate { transform: rotate(180deg); }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .sidebar-overlay {
            display: none;
        }
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .sidebar.mobile-open { transform: translateX(0); }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 30;
            }
            .sidebar-overlay.show { display: block; }
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased">
    @hasSection('custom_navbar')
        @yield('custom_navbar')
    @else
    <!-- NAVBAR -->
    <nav class="navbar-glass shadow-xl border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                @auth
                @if(auth()->user()->role === 'admin')
                <button id="admin-sidebar-toggle" class="lg:hidden text-white hover:text-blue-200 transition-colors p-2 rounded-lg hover:bg-white/10">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                @elseif(auth()->user()->role === 'siswa')
                <button id="student-sidebar-toggle" class="lg:hidden text-white hover:text-blue-200 transition-colors p-2 rounded-lg hover:bg-white/10">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                @endif
                @endauth
                <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : route('home') }}" class="flex items-center space-x-3 text-white font-bold text-xl tracking-wide">
                    <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo SMPN 1 Pirime" class="h-10 w-10 rounded-lg shadow-md border-2 border-white/20">
                    <span class="hidden sm:inline">SMPN 1 Pirime</span>
                </a>
            </div>
            <div class="flex items-center space-x-3">
                @auth
                <div class="relative" id="user-dropdown">
                    <button onclick="document.getElementById('user-menu').classList.toggle('hidden')" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl transition-all border border-white/10">
                        @if(auth()->user()->pendaftar?->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->pendaftar->foto_profil) }}" alt="Foto Profil" class="w-8 h-8 rounded-full object-cover border-2 border-white/30 shadow-lg">
                        @else
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center font-bold text-sm shadow-lg">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        @endif
                        <span class="hidden sm:inline font-medium text-sm">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs opacity-70"></i>
                    </button>
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden z-50">
                        <div class="px-4 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-slate-100">
                            <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('siswa.dashboard') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-home mr-2 w-4"></i>Dashboard
                        </a>
                        <div class="border-t border-slate-100"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2 w-4"></i>Keluar
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
                @endauth
            </div>
        </div>
    </nav>
    @endif

    <!-- SIDEBAR & CONTENT -->
    @auth
    <div class="flex min-h-screen">
        @if(auth()->user()->role === 'admin')
        <!-- ADMIN SIDEBAR -->
        <aside class="sidebar sidebar-admin w-72 text-white shadow-2xl fixed lg:relative z-40 h-screen overflow-y-auto" id="sidebar">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl border border-white/20">
                        <i class="fas fa-user-shield text-2xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold">Admin Panel</h2>
                        <p class="text-blue-200 text-xs">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i><span>Dashboard</span>
                </a>

                <div class="sidebar-section">
                    <button onclick="toggleSubmenu('pendaftaran-submenu', 'pendaftaran-chevron')" class="w-full flex items-center px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition-all">
                        <i class="fas fa-users w-5 mr-3"></i><span>Manajemen Pendaftaran</span>
                        <i id="pendaftaran-chevron" class="fas fa-chevron-down ml-auto text-xs chevron"></i>
                    </button>
                    <div id="pendaftaran-submenu" class="submenu pl-4">
                        <a href="{{ route('admin.pendaftar') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.pendaftar') ? 'text-blue-300 bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Data Pendaftar</a>
                        <a href="{{ route('admin.detail', 1) }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.detail*') ? 'text-blue-300 bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Detail & Verifikasi</a>
                    </div>
                </div>

                <div class="sidebar-section">
                    <button onclick="toggleSubmenu('konten-submenu', 'konten-chevron')" class="w-full flex items-center px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition-all">
                        <i class="fas fa-layer-group w-5 mr-3"></i><span>Kelola Konten</span>
                        <i id="konten-chevron" class="fas fa-chevron-down ml-auto text-xs chevron"></i>
                    </button>
                    <div id="konten-submenu" class="submenu pl-4">
                        <a href="{{ route('admin.pengumuman') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.pengumuman*') ? 'text-blue-300 bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Pengumuman</a>
                        <a href="{{ route('admin.gallery.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.gallery*') ? 'text-blue-300 bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Galeri Foto</a>
                    </div>
                </div>

                <a href="{{ route('admin.laporan') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.laporan') ? 'active text-white' : 'text-slate-300 hover:text-white' }}">
                    <i class="fas fa-chart-line w-5 mr-3"></i><span>Laporan & Analytics</span>
                </a>

                <div class="sidebar-section">
                    <button onclick="toggleSubmenu('pengaturan-submenu', 'pengaturan-chevron')" class="w-full flex items-center px-4 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition-all">
                        <i class="fas fa-cogs w-5 mr-3"></i><span>Pengaturan Sistem</span>
                        <i id="pengaturan-chevron" class="fas fa-chevron-down ml-auto text-xs chevron"></i>
                    </button>
                    <div id="pengaturan-submenu" class="submenu pl-4">
                        <a href="{{ route('admin.pengaturan') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.pengaturan') ? 'text-blue-300 bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Pengaturan Umum</a>
                    </div>
                </div>
            </nav>
        </aside>
        @else
        <!-- STUDENT SIDEBAR -->
        <aside class="sidebar sidebar-student w-72 text-white shadow-2xl fixed lg:relative z-40 h-screen overflow-y-auto" id="student-sidebar">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-xl border border-white/20">
                        <i class="fas fa-user-graduate text-xl text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold">Dashboard Siswa</h2>
                        <p class="text-blue-200 text-xs">PPDB SMPN 1 Pirime</p>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-3 border border-white/10">
                    <div class="flex items-center space-x-3">
                        @if(auth()->user()->pendaftar?->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->pendaftar->foto_profil) }}" alt="Foto Profil" class="w-10 h-10 rounded-lg object-cover border border-white/20 shadow-lg">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-lg flex items-center justify-center shadow-lg font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
                            <p class="text-blue-200 text-xs">{{ auth()->user()->pendaftar?->nomor_pendaftaran ?? 'Belum Daftar' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('siswa.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('siswa.dashboard') ? 'active text-white' : 'text-blue-100 hover:text-white' }}">
                    <i class="fas fa-home w-5 mr-3"></i><span>Dashboard</span>
                </a>

                <div class="sidebar-section">
                    <button onclick="toggleSubmenu('siswa-pendaftaran-submenu', 'siswa-pendaftaran-chevron')" class="w-full flex items-center px-4 py-3 rounded-xl text-blue-100 hover:text-white hover:bg-white/5 transition-all">
                        <i class="fas fa-clipboard-list w-5 mr-3"></i><span>Pendaftaran PPDB</span>
                        <i id="siswa-pendaftaran-chevron" class="fas fa-chevron-down ml-auto text-xs chevron"></i>
                    </button>
                    <div id="siswa-pendaftaran-submenu" class="submenu pl-4">
                        <a href="{{ route('siswa.pendaftaran') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.pendaftaran') ? 'text-cyan-300 bg-white/10' : 'text-blue-200 hover:text-white hover:bg-white/5' }}">Form Pendaftaran</a>
                        <a href="{{ route('siswa.ppdb.berkas') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.ppdb.berkas') ? 'text-cyan-300 bg-white/10' : 'text-blue-200 hover:text-white hover:bg-white/5' }}">Upload Berkas</a>
                    </div>
                </div>

                <div class="sidebar-section">
                    <button onclick="toggleSubmenu('siswa-status-submenu', 'siswa-status-chevron')" class="w-full flex items-center px-4 py-3 rounded-xl text-blue-100 hover:text-white hover:bg-white/5 transition-all">
                        <i class="fas fa-info-circle w-5 mr-3"></i><span>Status & Dokumen</span>
                        <i id="siswa-status-chevron" class="fas fa-chevron-down ml-auto text-xs chevron"></i>
                    </button>
                    <div id="siswa-status-submenu" class="submenu pl-4">
                        <a href="{{ route('siswa.status') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.status') ? 'text-cyan-300 bg-white/10' : 'text-blue-200 hover:text-white hover:bg-white/5' }}">Status Pendaftaran</a>
                        <a href="{{ route('siswa.cetak') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.cetak') ? 'text-cyan-300 bg-white/10' : 'text-blue-200 hover:text-white hover:bg-white/5' }}">Cetak Bukti PDF</a>
                    </div>
                </div>

                <a href="{{ route('siswa.pengumuman') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('siswa.pengumuman') ? 'active text-white' : 'text-blue-100 hover:text-white' }}">
                    <i class="fas fa-bullhorn w-5 mr-3"></i><span>Pengumuman</span>
                </a>

                <div class="mt-6 p-4 bg-white/5 rounded-xl border border-white/10">
                    <h3 class="text-xs font-bold text-blue-300 uppercase mb-2">Status Pendaftaran</h3>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-blue-200">Verifikasi</span>
                        <span class="text-xs px-2 py-1 bg-yellow-500/20 text-yellow-200 rounded-full">Menunggu</span>
                    </div>
                </div>
            </nav>
        </aside>
        @endif

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="sidebar-overlay" onclick="closeSidebars()"></div>

        <main class="flex-1 p-6 lg:p-8 min-h-screen">
            @yield('content')
        </main>
    </div>
    @else
    <main class="min-h-screen">
        @yield('content')
    </main>
    @endauth

    <!-- FOOTER -->
    <footer class="bg-gradient-to-r from-slate-900 to-slate-800 text-white py-8 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo SMPN 1 Pirime" class="h-14 w-14 mx-auto mb-3 rounded-xl shadow-xl border-2 border-white/20">
            <h3 class="text-xl font-bold mb-1">SMPN 1 Pirime</h3>
            <p class="text-slate-400 text-sm">Sistem PPDB Online v2.0 &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    <script>
        function toggleSubmenu(id, chevronId) {
            const submenu = document.getElementById(id);
            const chevron = document.getElementById(chevronId);
            submenu.classList.toggle('open');
            chevron.classList.toggle('rotate');
        }

        function closeSidebars() {
            document.getElementById('sidebar')?.classList.remove('mobile-open');
            document.getElementById('student-sidebar')?.classList.remove('mobile-open');
            document.getElementById('sidebar-overlay').classList.remove('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Auto-open submenu if child is active
            document.querySelectorAll('.submenu a').forEach(link => {
                if (link.classList.contains('text-blue-300') || link.classList.contains('text-cyan-300')) {
                    const submenu = link.closest('.submenu');
                    if (submenu) {
                        submenu.classList.add('open');
                        const chevronId = submenu.id.replace('-submenu', '-chevron');
                        document.getElementById(chevronId)?.classList.add('rotate');
                    }
                }
            });

            // Mobile toggles
            document.getElementById('admin-sidebar-toggle')?.addEventListener('click', () => {
                document.getElementById('sidebar').classList.add('mobile-open');
                document.getElementById('sidebar-overlay').classList.add('show');
            });
            document.getElementById('student-sidebar-toggle')?.addEventListener('click', () => {
                document.getElementById('student-sidebar').classList.add('mobile-open');
                document.getElementById('sidebar-overlay').classList.add('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('user-dropdown');
                const menu = document.getElementById('user-menu');
                if (dropdown && menu && !dropdown.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

