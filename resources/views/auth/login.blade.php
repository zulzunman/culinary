<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page with Map</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* Base Styles and Variables */
        :root {
            --primary-color: #2F4F4F;
            --primary-light: #4d7a7a;
            --secondary-color: #f8f9fa;
            --accent-color: #FF6B6B;
            --text-dark: #333;
            --text-light: #f8f9fa;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.1);
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: #f5f5f5;
        }

        /* Navbar Styling */
        .navbar {
            box-shadow: var(--shadow-sm);
            padding: 12px 0;
            background-color: white !important;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            color: var(--primary-light);
        }

        .navbar-nav .nav-item {
            margin-left: 10px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Carousel Styling */
        .carousel {
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-bottom: 40px;
        }

        .carousel-item {
            height: 450px;
            background-color: var(--secondary-color);
            position: relative;
            overflow: hidden;
        }

        .carousel-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4));
            z-index: 1;
        }

        .carousel-item h3 {
            position: relative;
            z-index: 2;
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            z-index: 10;
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 20px;
            height: 20px;
            filter: invert(1) grayscale(100%);
        }

        /* Info Section Styling */
        .bg-teal {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: var(--text-light);
            padding: 50px 20px;
            margin-bottom: 50px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        @media (min-width: 992px) {
            .grid-container {
                grid-template-columns: 0.5fr 1.5fr;
            }
        }

        .info-section {
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: var(--radius-md);
            transition: var(--transition);
        }

        .info-section:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 10px;
        }

        .section-header h2 {
            font-size: 28px;
            margin: 0;
            font-weight: 600;
        }

        .info-content {
            margin-left: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 18px;
            transition: var(--transition);
        }

        .contact-item:hover {
            transform: translateX(5px);
        }

        .hours-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 18px;
        }

        .hours-grid div:nth-child(odd) {
            font-weight: 600;
        }

        .bi {
            font-size: 24px;
        }

        /* Map Styling */
        .map-section {
            width: 100%;
            padding-bottom: 40px;
            margin-bottom: 20px;
        }

        .map-section h3 {
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            color: white;
        }

        #map {
            height: 500px;
            width: 100%;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        /* Login Modal Styling */
        .modal-content {
            border: none;
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .card {
            border: none;
            box-shadow: none;
        }

        .card-body {
            padding: 30px;
        }

        .app-brand-text {
            font-size: 28px;
            color: var(--primary-color) !important;
            font-weight: 700;
        }

        .form-control {
            padding: 12px;
            border-radius: var(--radius-md);
            border: 1px solid #ddd;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(47, 79, 79, 0.25);
        }

        .input-group-text {
            background-color: white;
            border-color: #ddd;
        }

        .btn-outline-secondary {
            border-color: #ddd;
            color: #777;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #555;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .carousel-item {
                height: 300px;
            }

            .section-header h2 {
                font-size: 24px;
            }

            .contact-item,
            .hours-grid {
                font-size: 16px;
            }

            #map {
                height: 400px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center">
                <svg height="40" width="40" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                    class="me-2">
                    <style>
                        .st0 {
                            fill: #000000;
                        }
                    </style>
                    <g>
                        <path class="st0" d="M256,0C114.613,0,0,114.615,0,256s114.613,256,256,256c141.383,0,256-114.615,256-256S397.383,0,256,0z
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
                Lengkong Culinary Night
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <a class="navbar-brand">Informasi</a>
                <a class="navbar-brand">Kontak Kami</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            Login
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div class="container mt-4  mb-5">
        <div id="carouselExample" class="carousel slide mb-4">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <h3>Lengkong Culinary Night</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <h3>Slide 2</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <h3>Slide 3</h3>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="bg-teal">
            <div class="container">
                <div class="grid-container">
                    <!-- Left Section - Info -->
                    <div>
                        <!-- Location Section -->
                        <div class="info-section">
                            <div class="section-header">
                                <i class="bi bi-geo-alt-fill"></i>
                                <h2>Location</h2>
                            </div>
                            <div class="info-content">
                                <div class="contact-item">
                                    <i class="bi bi-house-fill"></i>
                                    <p>Jl. Lengkong Kota Bandung</p>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone-fill"></i>
                                    <p>+62 899-2310-069</p>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope-fill"></i>
                                    <p>lengkongpride@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Opening Hours Section -->
                        <div class="info-section">
                            <div class="section-header">
                                <i class="bi bi-clock-fill"></i>
                                <h2>Opening Hours</h2>
                            </div>
                            <div class="info-content">
                                <div class="hours-grid">
                                    <div>Monday</div>
                                    <div>10:00 - 21:00</div>
                                    <div>Tuesday</div>
                                    <div>10:00 - 21:00</div>
                                    <div>Wednesday</div>
                                    <div>10:00 - 21:00</div>
                                    <div>Thursday</div>
                                    <div>10:00 - 21:00</div>
                                    <div>Friday</div>
                                    <div>10:00 - 21:00</div>
                                    <div>Saturday</div>
                                    <div>10:00 - 21:00</div>
                                    <div>Sunday</div>
                                    <div>10:00 - 21:00</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="map-section">
                        <h3 class="text-center">Peta Lokasi Lapak</h3>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="card px-sm-4 px-2">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4">
                            <a class="d-flex flex-column align-items-center">
                                <span class="app-brand-text demo text-heading fw-bold fs-3 text-decoration-none">Login
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username" autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Masukkan Password" required minlength="8" />
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn rounded-pill btn-primary d-grid w-100"
                                    type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Custom Map Script -->
    <script src="{{ asset('style/js/map.js') }}"></script>
    <script>
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
    </script>

</body>

</html>
