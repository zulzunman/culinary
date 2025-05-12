<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Pembokingan Lapak Lengkong</title>
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('style/assets/img/favicon/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/apex-charts/apex-charts.css') }}">


    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('style/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('style/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.sidebar')

            <!-- Layout container -->
            <div class="layout-page">
                @include('layouts.header')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl position-relative">
                        @if (session('success'))
                            <div class="bs-toast toast fade show position-absolute top-0 end-0 m-3" role="alert"
                                aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000"
                                style="background-color: #39962D;">
                                <div class="toast-header">
                                    <i class="bx bx-check-circle me-2" style="color: black;"></i>
                                    <div class="me-auto fw-medium" style="color: black;">Success</div>
                                    <small style="color: black;">Just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body" style="color: black;">
                                    {{ session('success') }}
                                </div>
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 0%;"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bs-toast toast fade show position-absolute top-0 end-0 m-3" role="alert"
                                aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000"
                                style="background-color: #CC0707;">
                                <div class="toast-header">
                                    <i class="bx bx-error-circle me-2" style="color: black;"></i>
                                    <div class="me-auto fw-medium" style="color: black;">Error</div>
                                    <small style="color: black;">Just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <div class="toast-body" style="color: black;">
                                    {{ session('error') }}
                                </div>
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 0%;"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="{{ asset('style/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/menu.js') }}"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('style/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('style/assets/js/main.js') }}"></script>
    <script src="{{ asset('style/assets/js/dashboards-analytics.js') }}"></script>

    <!-- GitHub Buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Notification Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElements = document.querySelectorAll('.toast');
            toastElements.forEach(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 5000
                });

                toast.show();

                // Progress bar animation
                var progressBar = toastEl.querySelector('.progress-bar');
                progressBar.style.transition = 'width 5s linear';

                // Trigger reflow to enable transition
                progressBar.offsetWidth;

                progressBar.style.width = '100%';

                // Ensure toast closes after 5 seconds
                setTimeout(function() {
                    toast.hide();
                }, 5000);
            });
        });
        // Add this to your script to include CSRF token in AJAX requests
        document.addEventListener('DOMContentLoaded', function() {
            // Set up CSRF token for AJAX requests
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Add to all fetch requests
            window.fetch = new Proxy(window.fetch, {
                apply: function(fetch, that, args) {
                    // If it's a Request
                    if (args[0] instanceof Request) {
                        if (args[0].method !== 'GET') {
                            const req = new Request(args[0], {
                                headers: new Headers({
                                    ...Object.fromEntries(args[0].headers.entries()),
                                    'X-CSRF-TOKEN': token
                                })
                            });
                            args[0] = req;
                        }
                    }
                    // If it's a URL string and has a second config object
                    else if (typeof args[1] === 'object' && args[1] !== null) {
                        if (args[1].method && args[1].method !== 'GET') {
                            args[1].headers = {
                                ...args[1].headers,
                                'X-CSRF-TOKEN': token
                            };
                        }
                    }
                    return fetch.apply(that, args);
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
