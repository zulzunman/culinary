<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkong Culinary Night | Wisata Kuliner Bandung</title>
    <meta name="description" content="Temukan beragam kuliner lezat di Lengkong Culinary Night, destinasi wisata kuliner malam terbaik di Bandung.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/lengkong.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="logo-container me-2">
                    <svg height="40" width="40" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path class="logo-path" d="M256,0C114.613,0,0,114.615,0,256s114.613,256,256,256c141.383,0,256-114.615,256-256S397.383,0,256,0z
                                M379.652,402.722v-98.774v-8.938v-3.573v-7.201V161.333c0-5.3-2.656-10.245-7.066-13.177c-4.039-2.694-9.059-3.346-13.629-1.862
                                c-0.422,0.131-0.84,0.263-1.254,0.432l-41.98,17.577c-5.051,2.11-8.648,6.681-9.524,12.083l-10.84,127.164
                                c-0.728,4.531,0.539,9.165,3.488,12.681c2.945,3.524,36.008,32.46,36.008,32.46v82.297C310.779,441.882,284.098,448,256,448
                                c-16.172,0-31.871-2.032-46.885-5.814V299.032c4.186-1.114,8.139-2.521,11.822-4.191c7.184-3.25,13.348-7.422,18.488-11.992
                                c7.727-6.875,13.176-14.562,16.832-21.803c1.828-3.634,3.211-7.164,4.191-10.584c0.496-1.707,0.883-3.396,1.16-5.104
                                c0.278-1.708,0.453-3.43,0.453-5.294c0-11.474,0-78.701,0-78.701c0-8.754-7.098-15.846-15.848-15.846s-15.84,7.092-15.84,15.846
                                c0,0,0,1.051,0,2.916c0,9.157,0,37.98,0,57.756c0,7.539-6.117,13.657-13.664,13.657c-7.543,0-13.656-6.118-13.656-13.657
                                c0-23.81,0-59.578,0-59.578c0-8.748-7.098-15.846-15.852-15.846c-8.752,0-15.848,7.098-15.848,15.846c0,0,0,1.056,0,2.912
                                c0,8.995,0,36.938,0,56.666c0,7.539-6.114,13.657-13.66,13.657c-7.543,0-13.656-6.118-13.656-13.657c0-23.791,0-60.672,0-60.672
                                c0-8.754-7.094-15.846-15.846-15.846c-8.752,0-15.85,7.092-15.85,15.846c0,0,0,1.051,0,2.916c0,13.02,0,65.742,0,75.785
                                c0.008,1.66,0.141,3.201,0.365,4.723c0.428,2.846,1.154,5.646,2.16,8.558c1.764,5.057,4.396,10.408,8.068,15.813
                                c2.758,4.043,6.105,8.092,10.121,11.926c6.014,5.736,13.563,10.974,22.664,14.732c3.023,1.251,6.226,2.312,9.574,3.201v126.154
                                C105.051,392.741,64,329.081,64,256c0-105.869,86.129-192,192-192c105.867,0,192,86.131,192,192
                                C448,314.796,421.408,367.474,379.652,402.722z" />
                        </g>
                    </svg>
                </div>
                <span class="brand-text">Lengkong<span class="text-primary fw-bold">Culinary</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeri">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lokasi">Lokasi</a>
                    </li>
                    <li class="nav-item ms-2">
                        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-person-fill me-1"></i> Login
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="display-4 fw-bold text-white">Wisata Kuliner Malam <span class="text-primary">Bandung</span></h1>
                    <p class="lead text-white-50 my-4">Nikmati ragam kuliner lezat dan suasana malam yang menakjubkan di pusat Kota Bandung</p>
                    <div class="d-flex gap-3">
                        <a href="#lokasi" class="btn btn-primary btn-lg rounded-pill">
                            <i class="bi bi-geo-alt-fill me-2"></i>Lihat Lokasi
                        </a>
                        <a href="#tentang" class="btn btn-outline-light btn-lg rounded-pill">
                            <i class="bi bi-info-circle-fill me-2"></i>Tentang Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>

    <!-- Featured Food Section -->
    <section id="tentang" class="featured-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Kuliner Populer</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Temukan ragam kuliner khas yang menggugah selera di Lengkong Culinary Night</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="food-card">
                        <div class="food-img-container">
                            <div class="food-img food-img-1"></div>
                        </div>
                        <div class="food-content">
                            <h3>Nasi Goreng Spesial</h3>
                            <p>Nasi goreng dengan bumbu rahasia khas Lengkong yang menggugah selera</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="food-price">Rp 25.000</span>
                                <span class="food-rating"><i class="bi bi-star-fill"></i> 4.8</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="food-card">
                        <div class="food-img-container">
                            <div class="food-img food-img-2"></div>
                        </div>
                        <div class="food-content">
                            <h3>Sate Maranggi</h3>
                            <p>Sate daging sapi dengan bumbu maranggi yang khas dan menyegarkan</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="food-price">Rp 35.000</span>
                                <span class="food-rating"><i class="bi bi-star-fill"></i> 4.9</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="food-card">
                        <div class="food-img-container">
                            <div class="food-img food-img-3"></div>
                        </div>
                        <div class="food-content">
                            <h3>Seblak Ceker</h3>
                            <p>Seblak pedas dengan ceker ayam, bakso dan mie yang menggoyang lidah</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="food-price">Rp 20.000</span>
                                <span class="food-rating"><i class="bi bi-star-fill"></i> 4.7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary rounded-pill">Lihat Menu Lainnya</a>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeri" class="gallery-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center mb-5">
                    <h2 class="section-title text-white" data-aos="fade-up">Galeri Suasana</h2>
                    <p class="section-subtitle text-white-50" data-aos="fade-up" data-aos-delay="100">Rasakan pengalaman kuliner malam yang tak terlupakan</p>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="gallery-item">
                        <div class="gallery-img gallery-img-1"></div>
                        <div class="gallery-overlay">
                            <h4>Suasana Malam</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="gallery-item">
                        <div class="gallery-img gallery-img-2"></div>
                        <div class="gallery-overlay">
                            <h4>Area Outdoor</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="gallery-item">
                        <div class="gallery-img gallery-img-3"></div>
                        <div class="gallery-overlay">
                            <h4>Live Music</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Contact Section -->
    <section id="lokasi" class="location-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center mb-5">
                    <h2 class="section-title" data-aos="fade-up">Lokasi & Kontak</h2>
                    <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Temukan kami di pusat Kota Bandung</p>
                </div>
            </div>

            <div class="location-container">
                <div class="row g-4">
                    <!-- Left Section - Info -->
                    <div class="col-lg-4" data-aos="fade-right">
                        <!-- Location Info -->
                        <div class="info-card">
                            <div class="info-header">
                                <i class="bi bi-geo-alt-fill"></i>
                                <h3>Alamat</h3>
                            </div>
                            <div class="info-content">
                                <div class="info-item">
                                    <i class="bi bi-house-fill"></i>
                                    <p>Jl. Lengkong Besar No.38, Paledang, Kota Bandung</p>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-telephone-fill"></i>
                                    <p>+62 899-2310-069</p>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-envelope-fill"></i>
                                    <p>lengkongpride@gmail.com</p>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-instagram"></i>
                                    <p>@lengkong_culinary</p>
                                </div>
                            </div>
                        </div>

                        <!-- Opening Hours -->
                        <div class="info-card mt-4">
                            <div class="info-header">
                                <i class="bi bi-clock-fill"></i>
                                <h3>Jam Operasional</h3>
                            </div>
                            <div class="info-content">
                                <div class="hours-grid">
                                    <div>Senin</div>
                                    <div>17:00 - 23:59</div>
                                    <div>Selasa</div>
                                    <div>17:00 - 23:59</div>
                                    <div>Rabu</div>
                                    <div>17:00 - 23:59</div>
                                    <div>Kamis</div>
                                    <div>17:00 - 23:59</div>
                                    <div>Jumat</div>
                                    <div>17:00 - 23:59</div>
                                    <div>Sabtu</div>
                                    <div>17:00 - 23:59</div>
                                    <div>Minggu</div>
                                    <div>17:00 - 23:59</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="col-lg-8" data-aos="fade-left">
                        <div class="map-container">
                            <h3 class="map-title">Peta Lokasi</h3>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <div class="logo-container me-2">
                            <svg height="30" width="30" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path class="logo-path-footer" d="M256,0C114.613,0,0,114.615,0,256s114.613,256,256,256c141.383,0,256-114.615,256-256S397.383,0,256,0z
                                        M379.652,402.722v-98.774v-8.938v-3.573v-7.201V161.333c0-5.3-2.656-10.245-7.066-13.177c-4.039-2.694-9.059-3.346-13.629-1.862
                                        c-0.422,0.131-0.84,0.263-1.254,0.432l-41.98,17.577c-5.051,2.11-8.648,6.681-9.524,12.083l-10.84,127.164
                                        c-0.728,4.531,0.539,9.165,3.488,12.681c2.945,3.524,36.008,32.46,36.008,32.46v82.297C310.779,441.882,284.098,448,256,448
                                        c-16.172,0-31.871-2.032-46.885-5.814V299.032c4.186-1.114,8.139-2.521,11.822-4.191c7.184-3.25,13.348-7.422,18.488-11.992
                                        c7.727-6.875,13.176-14.562,16.832-21.803c1.828-3.634,3.211-7.164,4.191-10.584c0.496-1.707,0.883-3.396,1.16-5.104
                                        c0.278-1.708,0.453-3.43,0.453-5.294c0-11.474,0-78.701,0-78.701c0-8.754-7.098-15.846-15.848-15.846s-15.84,7.092-15.84,15.846
                                        c0,0,0,1.051,0,2.916c0,9.157,0,37.98,0,57.756c0,7.539-6.117,13.657-13.664,13.657c-7.543,0-13.656-6.118-13.656-13.657
                                        c0-23.81,0-59.578,0-59.578c0-8.748-7.098-15.846-15.852-15.846c-8.752,0-15.848,7.098-15.848,15.846c0,0,0,1.056,0,2.912
                                        c0,8.995,0,36.938,0,56.666c0,7.539-6.114,13.657-13.66,13.657c-7.543,0-13.656-6.118-13.656-13.657c0-23.791,0-60.672,0-60.672
                                        c0-8.754-7.094-15.846-15.846-15.846c-8.752,0-15.85,7.092-15.85,15.846c0,0,0,1.051,0,2.916c0,13.02,0,65.742,0,75.785
                                        c0.008,1.66,0.141,3.201,0.365,4.723c0.428,2.846,1.154,5.646,2.16,8.558c1.764,5.057,4.396,10.408,8.068,15.813
                                        c2.758,4.043,6.105,8.092,10.121,11.926c6.014,5.736,13.563,10.974,22.664,14.732c3.023,1.251,6.226,2.312,9.574,3.201v126.154
                                        C105.051,392.741,64,329.081,64,256c0-105.869,86.129-192,192-192c105.867,0,192,86.131,192,192
                                        C448,314.796,421.408,367.474,379.652,402.722z" />
                                </g>
                            </svg>
                        </div>
                        <span class="footer-brand">Lengkong<span class="fw-bold">Culinary</span></span>
                    </div>
                    <p class="footer-text">Pusat kuliner malam yang menyajikan berbagai makanan lezat dengan suasana yang nyaman di tengah Kota Bandung.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h4 class="footer-title">Tautan</h4>
                    <ul class="footer-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#galeri">Galeri</a></li>
                        <li><a href="#lokasi">Lokasi</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h4 class="footer-title">Vendor</h4>
                    <ul class="footer-links">
                        <li><a href="#">Pendaftaran</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-title">Berlangganan</h4>
                    <p class="footer-text">Dapatkan update terbaru dari kami</p>
                    <form class="subscription-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email Anda" required>
                            <button class="btn btn-primary" type="submit"><i class="bi bi-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; 2025 Lengkong Culinary Night. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Designed with <i class="bi bi-heart-fill text-danger"></i> in Bandung</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="card px-sm-4 px-2">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4">
                            <a class="d-flex flex-column align-items-center">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="logo-container me-2">
                                        <svg height="40" width="40" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path class="logo-path" d="M256,0C114.613,0,0,114.615,0,256s114.613,256,256,256c141.383,0,256-114.615,256-256S397.383,0,256,0z
                                                    M379.652,402.722v-98.774v-8.938v-3.573v-7.201V161.333c0-5.3-2.656-10.245-7.066-13.177c-4.039-2.694-9.059-3.346-13.629-1.862
                                                    c-0.422,0.131-0.84,0.263-1.254,0.432l-41.98,17.577c-5.051,2.11-8.648,6.681-9.524,12.083l-10.84,127.164
                                                    c-0.728,4.531,0.539,9.165,3.488,12.681c2.945,3.524,36.008,32.46,36.008,32.46v82.297C310.779,441.882,284.098,448,256,448
                                                    c-16.172,0-31.871-2.032-46.885-5.814V299.032c4.186-1.114,8.139-2.521,11.822-4.191c7.184-3.25,13.348-7.422,18.488-11.992
                                                    c7.727-6.875,13.176-14.562,16.832-21.803c1.828-3.634,3.211-7.164,4.191-10.584c0.496-1.707,0.883-3.396,1.16-5.104
                                                    c0.278-1.708,0.453-3.43,0.453-5.294c0-11.474,0-78.701,0-78.701c0-8.754-7.098-15.846-15.848-15.846s-15.84,7.092-15.84,15.846
                                                    c0,0,0,1.051,0,2.916c0,9.157,0,37.98,0,57.756c0,7.539-6.117,13.657-13.664,13.657c-7.543,0-13.656-6.118-13.656-13.657
                                                    c0-23.81,0-59.578,0-59.578c0-8.748-7.098-15.846-15.852-15.846c-8.752,0-15.848,7.098-15.848,15.846c0,0,0,1.056,0,2.912
                                                    c0,8.995,0,36.938,0,56.666c0,7.539-6.114,13.657-13.66,13.657c-7.543,0-13.656-6.118-13.656-13.657c0-23.791,0-60.672,0-60.672
                                                    c0-8.754-7.094-15.846-15.846-15.846c-8.752,0-15.85,7.092-15.85,15.846c0,0,0,1.051,0,2.916c0,13.02,0,65.742,0,75.785
                                                    c0.008,1.66,0.141,3.201,0.365,4.723c0.428,2.846,1.154,5.646,2.16,8.558c1.764,5.057,4.396,10.408,8.068,15.813
                                                    c2.758,4.043,6.105,8.092,10.121,11.926c6.014,5.736,13.563,10.974,22.664,14.732c3.023,1.<!-- Login Modal (lanjutan) -->
                                                    c3.023,1.251,6.226,2.312,9.574,3.201v126.154
                                                    C105.051,392.741,64,329.081,64,256c0-105.869,86.129-192,192-192c105.867,0,192,86.131,192,192
                                                    C448,314.796,421.408,367.474,379.652,402.722z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="brand-text">Lengkong<span class="text-primary fw-bold">Culinary</span></span>
                                </div>
                                <span class="app-brand-text fw-semibold fs-3">Login</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email" autofocus required />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Masukkan Password" required minlength="8" />
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                                    <label class="form-check-label" for="remember-me">
                                        Ingat saya
                                    </label>
                                </div>
                                <a href="#" class="text-primary small">Lupa password?</a>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100 rounded-pill" type="submit">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('style/js/map.js') }}"></script>
    <script>
        // Initialize AOS
        AOS.init();

        // Navbar color change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Password toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            let passwordInput = document.getElementById('password');
            let icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });

        // Tambahkan script untuk menginisialisasi peta
        document.addEventListener('DOMContentLoaded', function() {
            // Koordinat Lengkong Bandung
            const lengkongLocation = [-6.9244, 107.6184];

            // Inisialisasi peta
            const map = L.map('map').setView(lengkongLocation, 17);

            // Tambahkan tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Tambahkan marker dengan popup
            L.marker(lengkongLocation).addTo(map)
                .bindPopup('<b>Lengkong Culinary Night</b><br>Jl. Lengkong Besar No.38, Bandung')
                .openPopup();
        });
    </script>
</body>

</html>