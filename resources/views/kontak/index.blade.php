<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - SMP YPK Kotaraja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-kontak {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://www.smpypkkotaraja.sch.id/upload/picture/13698337620200519102455.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .contact-card {
            transition: transform 0.3s;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .map-container {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('kontak') }}">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('guru') }}">Guru</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ppdb') }}">PPDB</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-kontak text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Hubungi Kami</h1>
            <p class="lead">Informasi kontak lengkap SMP YPK Kotaraja</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-6 mb-5">
                    <h2 class="display-5 fw-bold text-primary mb-4">Informasi Kontak</h2>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-lg border-0 contact-card h-100">
                                <div class="card-body p-4 text-center">
                                    <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Telepon</h5>
                                    <p class="card-text">{{ $data['telepon'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card shadow-lg border-0 contact-card h-100">
                                <div class="card-body p-4 text-center">
                                    <i class="fas fa-envelope fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Email</h5>
                                    <div class="card-text">
                                        @foreach($data['email'] as $email)
                                            <p class="mb-1">{{ $email }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="card shadow-lg border-0 contact-card">
                                <div class="card-body p-4 text-center">
                                    <i class="fas fa-map-marker-alt fa-3x text-warning mb-3"></i>
                                    <h5 class="card-title">Alamat</h5>
                                    <p class="card-text">{{ $data['alamat'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="text-center mb-3">Media Sosial</h4>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="#" class="btn btn-primary btn-lg rounded-circle">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-lg rounded-circle">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-lg rounded-circle">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-success btn-lg rounded-circle">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map and Contact Form -->
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold text-primary mb-4">Lokasi Sekolah</h2>

                    <!-- Map -->
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-body p-0">
                            <div class="map-container">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6500000000005!2d140.675!3d-2.583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMsKwMzQnMTAuOCJTIDE0MMKwNDAnMzAuMCJF!5e0!3m2!1sen!2sid!4v1634567890123!5m2!1sen!2sid"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Kirim Pesan</h5>
                        </div>
                        <div class="card-body p-4">
                            <form>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subjek" class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subjek" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pesan" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="pesan" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Operating Hours -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold text-primary mb-4">Jam Operasional</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0">
                                <div class="card-body p-5">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock fa-2x text-primary me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">Senin - Jumat</h6>
                                                    <p class="mb-0 text-muted">07:00 - 15:00 WIT</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-times fa-2x text-warning me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">Sabtu - Minggu</h6>
                                                    <p class="mb-0 text-muted">Tutup</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Untuk keperluan darurat, dapat menghubungi nomor telepon sekolah
                                    </p>
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
