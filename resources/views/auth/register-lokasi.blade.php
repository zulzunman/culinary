<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Lapak</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .location-box {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 12px;
            padding: 15px;
            width: 200px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1000;
        }

        .location-box h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .main-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 32px;
        }

        .subtitle {
            color: #666;
            font-weight: 400;
            margin-bottom: 30px;
            font-size: 18px;
        }

        .form-section {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            margin-bottom: 20px;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
            font-size: 20px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 50px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border-radius: 3px;
        }

        .section-title.text-primary:after {
            background: linear-gradient(to right, #4a8eff, #2575fc);
        }

        .section-title.text-success:after {
            background: linear-gradient(to right, #28a745, #20c997);
        }

        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
            border-color: #6a11cb;
        }

        .btn {
            padding: 12px 30px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5f10b5 0%, #2167db 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 117, 252, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(108, 117, 125, 0.3);
        }

        .alert-danger {
            background-color: #fff5f5;
            color: #e74c3c;
            border-left: 4px solid #e74c3c;
            border-radius: 8px;
            padding: 15px 20px;
        }

        .alert-danger h1 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .alert-danger ul {
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            .location-box {
                position: relative;
                top: 0;
                right: 0;
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <!-- Location Box -->
            <div class="location-box">
                <h3><strong>{{ $location->code }}</strong></h3>
                <input type="hidden" name="location_id" id="location_id"
                    class="form-control @error('location_id') is-invalid @enderror" value="{{ $location->id }}"
                    required>
                @error('location_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <h2 class="text-center main-title">Pengajuan Lapak</h2>
            <p class="text-center subtitle">Silakan isi data pengajuan</p>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <h1><i class="fas fa-exclamation-circle me-2"></i>ERROR!</h1>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="hidden" name="location_id" value="{{ $location->id }}">
                <!-- Personal Information -->
                <div class="form-section">
                    <h4 class="section-title text-primary"><i class="fas fa-user me-2"></i>Personal Information</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" name="nik" id="nik"
                                class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}"
                                required>
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">No HP</label>
                            <input type="tel" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Store Information -->
                <div class="form-section">
                    <h4 class="section-title text-success"><i class="fas fa-store me-2"></i>Store Information</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name_product" class="form-label">Nama Toko</label>
                            <input type="text" name="name_product" id="name_product"
                                class="form-control @error('name_product') is-invalid @enderror"
                                value="{{ old('name_product') }}" required>
                            @error('name_product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Jenis Dagangan</label>
                            <input type="text" name="category" id="category"
                                class="form-control @error('category') is-invalid @enderror"
                                value="{{ old('category') }}" required>
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="desctiption" class="form-label">Deskripsi Toko</label>
                            <textarea name="desctiption" id="desctiption" rows="3"
                                class="form-control @error('desctiption') is-invalid @enderror" required>{{ old('desctiption') }}</textarea>
                            @error('desctiption')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('login') }}" class="btn rounded-pill btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn rounded-pill btn-primary">
                        Register<i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
