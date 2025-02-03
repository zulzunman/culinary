<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Lapak</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">Pengajuan Lapak</h2>
        <h2 class="text-center mb-4">Silakan isi data pengajuan</h2>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    <h1>ERROR!</h1>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Personal Information -->
            <div class="p-4 mb-4 bg-light border rounded">
                <h4 class="text-primary mb-3">Personal Information</h4>
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
                    <div class="col-md-12">
                        <label for="location_id" class="form-label">Lokasi</label>
                        <p><strong>Kode:</strong> {{ $location->code }}</p>
                        <input type="hidden" name="location_id" id="location_id"
                            class="form-control @error('location_id') is-invalid @enderror" value="{{ $location->id }}"
                            required>
                        @error('location_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Store Information -->
            <div class="p-4 mb-4 bg-light border rounded">
                <h4 class="text-success mb-3">Store Information</h4>
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
                            class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}"
                            required>
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
            <div class="d-flex justify-content-between">
                <a href="{{ route('login') }}" class="btn rounded-pill btn-secondary">Back</a>
                <button type="submit" class="btn rounded-pill btn-primary">Register</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
