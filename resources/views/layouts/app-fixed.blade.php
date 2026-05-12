<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - SMPN 1 Pirime')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #c7cad4 0%, #7cb5ff 100%); }
        .navbar-glass { background: rgba(30, 58, 138, 0.8); backdrop-filter: blur(12px); }
        .sidebar { background: rgba(0, 0, 0, 0.65); backdrop-filter: blur(10px); min-height: 100vh; }
        .hover-smooth { transition: 0.25s ease; }
        .hover-smooth:hover { transform: translateX(5px); opacity: 0.9; }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- NAVBAR -->
    <nav class="navbar-glass shadow-xl border-b border-blue-700/30">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-white font-bold text-xl tracking-wide">
                <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo SMPN 1 Pirime" class="h-10 w-10 rounded-lg shadow-md">
                <span>SMPN 1 Pirime</span>
            </a>
            <div class="flex items-center space-x-3">
                @auth
                <div class="dropdown dropstart">
                    <button class="btn btn-secondary dropdown-toggle bg-blue-700 hover:bg-blue-800 text-white border-0 px-4 py-2 rounded-lg shadow-md flex items-center space-x-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-white/20 flex items-center justify-center">
                            @if(auth()->user()->photo)
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-full h-full object-cover" alt="Foto admin">
                            @else
                                <span class="text-blue-700 font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <span>{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu shadow-lg">
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2 text-red-600"></i>Logout
                        </a></li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- SIDEBAR & CONTENT -->
    @auth
    <div class="flex">
        @if(auth()->user()->role === 'admin')
        <!-- ADMIN SIDEBAR -->
        <aside class="sidebar text-white p-5 space-y-3 w-64 hidden lg:block">
            <h2 class="text-xl font-semibold mb-6 border-b border-white/30 pb-4">
                <i class="fas fa-user-shield mr-2"></i>Admin Panel
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="block bg-gray-900/60 hover:bg-gray-800 px-4 py-3 rounded-lg hover-smooth">
                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
            </a>
            <a href="{{ route('admin.pendaftar') }}" class="block bg-gray-900/60 hover:bg-gray-800 px-4 py-3 rounded-lg hover-smooth">
                <i class="fas fa-users mr-3"></i>Data Pendaftar
            </a>
            <a href="{{ route('admin.pengumuman') }}" class="block bg-gray-900/60 hover:bg-gray-800 px-4 py-3 rounded-lg hover-smooth">
                <i class="fas fa-bullhorn mr-3"></i>Pengumuman
            </a>
            <a href="{{ route('admin.laporan') }}" class="block bg-gray-900/60 hover:bg-gray-800 px-4 py-3 rounded-lg hover-smooth">
                <i class="fas fa-chart-bar mr-3"></i>Laporan
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="block bg-green-600/80 hover:bg-green-500 px-4 py-3 rounded-lg hover-smooth shadow-lg">
                <i class="fas fa-images mr-3"></i>Kelola Galeri
            </a>
            <a href="{{ route('admin.pengaturan') }}" class="block bg-blue-600/80 hover:bg-blue-500 px-4 py-3 rounded-lg hover-smooth shadow-lg">
                <i class="fas fa-cog mr-3"></i>Pengaturan
            </a>
        </aside>
        @else
        <!-- STUDENT SIDEBAR (unchanged for now) -->
        @include('layouts.partials.student-sidebar')
        @endif
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
    @else
    <main class="p-8">@yield('content')</main>
    @endauth

    <!-- FOOTER WITH LOGO -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-8 mt-12 border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <img src="{{ asset('images/logo/logo-removebg-preview.jpg') }}" alt="Logo SMPN 1 Pirime" class="h-16 w-16 mx-auto mb-4 rounded-xl shadow-2xl border-4 border-white/20">
            <h3 class="text-2xl font-bold mb-2">SMPN 1 Pirime</h3>
            <p class="text-gray-300 mb-6">© {{ date('Y') }} Sistem PPDB Online. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

