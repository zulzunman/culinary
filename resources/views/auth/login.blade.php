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
        #map {
            height: 500px;
            width: 100%;
            margin-bottom: 30px;
        }

        .carousel-item {
            height: 400px;
            background-color: #f8f9fa;
        }

        /* Map Container Styles */
        .map-section {
            padding-bottom: 40px;
            /* Kurangi padding bottom */
            margin-bottom: 20px;
            /* Kurangi margin bottom */
        }

        /* Rest of your carousel control styles remain the same */
        .carousel-control-prev,
        .carousel-control-next {
            width: 60px;
            height: 60px;
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
            box-shadow: 5px 5px 10px #d1d1d1,
                -5px -5px 10px #ffffff;
            transition: all 0.3s ease;
        }

        .carousel-control-prev {
            left: 25px;
        }

        .carousel-control-next {
            right: 25px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            transform: translateY(-50%) scale(1.1);
            box-shadow: 3px 3px 6px #d1d1d1,
                -3px -3px 6px #ffffff;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 25px;
            height: 25px;
            background-color: #333;
            border-radius: 50%;
            position: relative;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .carousel-control-prev:active,
        .carousel-control-next:active {
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            box-shadow: inset 5px 5px 10px #d1d1d1,
                inset -5px -5px 10px #ffffff;
        }

        .app-brand a {
            text-decoration: none !important;
            /* Paksa menghapus garis bawah */
        }

        .app-brand-text {
            font-size: 28px;
            /* Sesuaikan ukuran */
            color: black !important;
            /* Paksa warna hitam */
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
    <div class="container mt-4">
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

        <!-- Map Container -->
        <div class="map-section">
            <h3 class="text-center">Peta Lokasi Lapak</h3>
            <div id="map"></div>
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
                                <button class="btn rounded-pill btn-primary d-grid w-100" type="submit">Login</button>
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
