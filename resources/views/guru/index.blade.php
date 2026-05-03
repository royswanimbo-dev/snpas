<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru & Staf - SMP YPK Kotaraja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-guru {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://www.smpypkkotaraja.sch.id/upload/picture/13698337620200519102455.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .guru-card {
            transition: transform 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }
        .guru-card:hover {
            transform: translateY(-10px);
        }
        .guru-image {
            height: 200px;
            object-fit: cover;
            border-bottom: 4px solid #007bff;
        }
        .guru-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('kesiswaan') }}">Kesiswaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('berita') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('guru') }}">Guru</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ppdb') }}">PPDB</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-guru text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Guru & Staf</h1>
            <p class="lead">Tenaga pengajar profesional SMP YPK Kotaraja</p>
        </div>
    </section>

    <!-- Guru Content -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Tim Pengajar Kami</h2>
                    <p class="lead text-muted">Dedikasi untuk mencetak generasi unggul</p>
                </div>

                @foreach($data['guru'] as $guru)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 guru-card h-100">
                        <img src="{{ $guru['foto'] }}" class="card-img-top guru-image" alt="{{ $guru['nama'] }}">
                        <div class="card-body guru-info text-center p-4">
                            <h5 class="card-title fw-bold">{{ $guru['nama'] }}</h5>
                            <p class="text-primary fw-semibold mb-2">{{ $guru['jabatan'] }}</p>
                            <p class="text-muted mb-0">{{ $guru['mata_pelajaran'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Statistics -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Statistik Tenaga Pengajar</h2>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 text-center h-100">
                        <div class="card-body p-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-user-tie fa-2x"></i>
                            </div>
                            <h3 class="card-title text-primary">1</h3>
                            <p class="card-text">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 text-center h-100">
                        <div class="card-body p-4">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-chalkboard-teacher fa-2x"></i>
                            </div>
                            <h3 class="card-title text-success">2</h3>
                            <p class="card-text">Guru Senior</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 text-center h-100">
                        <div class="card-body p-4">
                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-graduation-cap fa-2x"></i>
                            </div>
                            <h3 class="card-title text-warning">3</h3>
                            <p class="card-text">Guru Muda</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card shadow-lg border-0 text-center h-100">
                        <div class="card-body p-4">
                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h3 class="card-title text-info">6</h3>
                            <p class="card-text">Total Tenaga Pengajar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Commitment -->
            <div class="row">
                <div class="col-12 text-center">
                    <div class="card shadow-lg border-0 bg-primary text-white">
                        <div class="card-body p-5">
                            <h3 class="card-title mb-3">Komitmen Kami</h3>
                            <p class="card-text mb-4">Tim pengajar SMP YPK Kotaraja berkomitmen untuk memberikan pendidikan berkualitas tinggi dengan nilai-nilai Kristiani yang kuat, membentuk karakter siswa yang unggul dalam iman, ilmu, dan amal saleh.</p>
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <i class="fas fa-heart fa-2x mb-2"></i>
                                    <h6>Dedikasi</h6>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="fas fa-brain fa-2x mb-2"></i>
                                    <h6>Profesional</h6>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="fas fa-pray fa-2x mb-2"></i>
                                    <h6>Bertakwa</h6>
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
