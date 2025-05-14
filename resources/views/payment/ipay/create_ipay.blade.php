<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .form-header {
            border-bottom: 1px solid #e3e6f0;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            color: #4e73df;
        }

        .btn-submit {
            background-color: #4e73df;
            border-color: #4e73df;
            font-weight: 500;
        }

        .btn-submit:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .form-floating label {
            color: #6c757d;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        .colorP {
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="text-center">
                            <i class="bi bi-credit-card me-2"></i>Pembayaran Register
                        </h2>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="colorP">*Pembayaran registrasi sebesar Rp. 6.000.000</p>
                    <form action="{{ route('ipay.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 position-relative">
                            <div class="form-floating">
                                <input type="number" name="currency" id="currency" class="form-control"
                                    placeholder="Enter currency amount" required>
                                <label for="currency"><i class="bi bi-currency-dollar me-1"></i>Currency Amount</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="date" name="date" id="date" class="form-control" required>
                                <label for="date"><i class="bi bi-calendar me-1"></i>Payment Date</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="photo" class="form-label"><i class="bi bi-image me-1"></i>Payment
                                Proof</label>
                            <div class="input-group">
                                <input type="file" name="photo" id="photo" class="form-control"
                                    accept="image/*">
                                <label class="input-group-text" for="photo"><i class="bi bi-upload"></i></label>
                            </div>
                            <div class="form-text text-muted">Upload an image of your payment receipt</div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-check-circle me-1"></i>Submit Payment
                            </button>

                            <button type="button" class="btn btn-outline-danger"
                                onclick="document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i>Log out
                            </button>
                        </div>
                    </form>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
