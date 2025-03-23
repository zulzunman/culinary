<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Merchant Profile</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="text-center">
                            <i class="bi bi-person-vcard me-2"></i>Complete Merchant Profile
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

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('merchant.update-after-regist') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- NIK -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="text" name="nik" id="nik" class="form-control" placeholder="Enter NIK"
                                       value="{{ old('nik', $merchantProfile->nik ?? '') }}" required>
                                <label for="nik"><i class="bi bi-card-text me-1"></i>NIK (Nomor Induk Kependudukan)</label>
                            </div>
                        </div>

                        <!-- Full Name -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name"
                                       value="{{ old('name', $merchantProfile->name ?? '') }}" required>
                                <label for="name"><i class="bi bi-person me-1"></i>Full Name</label>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-gender-ambiguous me-1"></i>Gender</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Laki - laki"
                                           {{ (old('gender', $merchantProfile->gender ?? '') == 'Laki - laki') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Laki - laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Perempuan"
                                           {{ (old('gender', $merchantProfile->gender ?? '') == 'Perempuan') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number"
                                       value="{{ old('phone', $merchantProfile->phone ?? '') }}" required>
                                <label for="phone"><i class="bi bi-telephone me-1"></i>Phone Number</label>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="date" name="date" id="date" class="form-control"
                                       value="{{ old('date', $merchantProfile->date ?? '') }}" required>
                                <label for="date"><i class="bi bi-calendar me-1"></i>Date of Birth</label>
                            </div>
                        </div>

                        <!-- Religion -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <select name="religion_id" id="religion_id" class="form-select" required>
                                    <option value="">Select Religion</option>
                                    @foreach($religions as $religion)
                                        <option value="{{ $religion->id }}"
                                                {{ (old('religion_id', $merchantProfile->religion_id ?? '') == $religion->id) ? 'selected' : '' }}>
                                            {{ $religion->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="religion_id"><i class="bi bi-book me-1"></i>Religion</label>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <select name="city_id" id="city_id" class="form-select" required>
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                                {{ (old('city_id', $merchantProfile->city_id ?? '') == $city->id) ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="city_id"><i class="bi bi-building me-1"></i>City</label>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea name="address" id="address" class="form-control" style="height: 100px"
                                          placeholder="Enter your address" required>{{ old('address', $merchantProfile->address ?? '') }}</textarea>
                                <label for="address"><i class="bi bi-geo-alt me-1"></i>Address</label>
                            </div>
                        </div>

                        <!-- KTP Picture -->
                        <div class="mb-4">
                            <label for="ktp_picture" class="form-label">
                                <i class="bi bi-card-image me-1"></i>KTP Picture
                            </label>
                            <div class="input-group">
                                <input type="file" name="ktp_picture" id="ktp_picture" class="form-control" accept="image/*">
                                <label class="input-group-text" for="ktp_picture"><i class="bi bi-upload"></i></label>
                            </div>
                            <div class="form-text text-muted">Upload a clear image of your KTP (ID Card)</div>

                            @if(!empty($merchantProfile->ktp_picture))
                                <div class="mt-2">
                                    <p class="text-muted">Current KTP Image:</p>
                                    <img src="{{ asset($merchantProfile->ktp_picture) }}" alt="KTP Picture" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-check-circle me-1"></i>Save Profile
                            </button>

                            <button type="button" class="btn btn-outline-danger"
                                onclick="document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
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