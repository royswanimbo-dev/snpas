<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesiswaan - SMP YPK Kotaraja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-kesiswaan {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://www.smpypkkotaraja.sch.id/upload/picture/13698337620200519102455.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .kesiswaan-card {
            transition: transform 0.3s;
        }
        .kesiswaan-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">SMP YPK KOTARAJA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('kesiswaan') }}">Kesiswaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('guru') }}">Guru</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ppdb') }}">PPDB</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-kesiswaan text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Kesiswaan</h1>
            <p class="lead">Informasi lengkap tentang kegiatan dan program kesiswaan</p>
        </div>
    </section>

    <!-- Kesiswaan Content -->
    <section class="py-5">
        <div class="container">
            <!-- Program Kesiswaan -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Program Kesiswaan</h2>
                    <p class="lead text-muted">Berbagai program pengembangan siswa di SMP YPK Kotaraja</p>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 kesiswaan-card h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">OSIS</h5>
                            <p class="card-text">Organisasi Siswa Intra Sekolah yang aktif dalam berbagai kegiatan sekolah</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 kesiswaan-card h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-campground fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Pramuka</h5>
                            <p class="card-text">Kegiatan pramuka untuk membentuk karakter dan kemandirian siswa</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 kesiswaan-card h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-music fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Ekstrakurikuler</h5>
                            <p class="card-text">Berbagai kegiatan ekstrakurikuler seperti seni, olahraga, dan lainnya</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 kesiswaan-card h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-book fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Literasi</h5>
                            <p class="card-text">Program literasi untuk meningkatkan minat baca siswa</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 kesiswaan-card h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Adiwiyata</h5>
                            <p class="card-text">Program peduli lingkungan dan kebersihan sekolah</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 kesiswaan-card h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-pray fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Kerohanian</h5>
                            <p class="card-text">Kegiatan keagamaan untuk membentuk akhlak mulia siswa</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prestasi Siswa -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Prestasi Siswa</h2>
                    <p class="lead text-muted">Pencapaian siswa SMP YPK Kotaraja</p>
                </div>

                <div class="col-lg-10 mx-auto">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-md-4 text-center mb-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-trophy fa-2x"></i>
                                    </div>
                                    <h5>Akademik</h5>
                                    <p>Juara dalam berbagai kompetisi akademik tingkat kabupaten dan provinsi</p>
                                </div>
                                <div class="col-md-4 text-center mb-4">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-running fa-2x"></i>
                                    </div>
                                    <h5>Olahraga</h5>
                                    <p>Berprestasi dalam cabang olahraga seperti sepak bola, voli, dan atletik</p>
                                </div>
                                <div class="col-md-4 text-center mb-4">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-palette fa-2x"></i>
                                    </div>
                                    <h5>Seni</h5>
                                    <p>Menampilkan bakat seni melalui berbagai lomba dan pertunjukan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kalender Akademik -->
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Kalender Akademik</h2>
                    <p class="lead text-muted">Jadwal penting tahun ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
                </div>

                <div class="col-lg-10 mx-auto">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Pembelajaran Tatap Muka</h6>
                                            <p class="mb-0 text-muted">Januari - Juni {{ date('Y')+1 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Ujian Akhir Semester</h6>
                                            <p class="mb-0 text-muted">Mei - Juni {{ date('Y')+1 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-holiday-vacation"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Libur Semester</h6>
                                            <p class="mb-0 text-muted">Juni - Juli {{ date('Y')+1 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-school"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Semester Genap</h6>
                                            <p class="mb-0 text-muted">Juli - Desember {{ date('Y')+1 }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} SMP YPK Kotaraja. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
