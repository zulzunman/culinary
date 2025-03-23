<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Store Data</title>
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

        .preview-image {
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-top: 0.5rem;
        }

        .preview-container {
            margin-top: 1rem;
            text-align: center;
        }

        .required::after {
            content: "*";
            color: red;
            margin-left: 3px;
        }

        .photo-section {
            margin-top: 1.5rem;
            border-top: 1px solid #e3e6f0;
            padding-top: 1.5rem;
        }

        .photo-section-title {
            color: #4e73df;
            margin-bottom: 1rem;
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
                            <i class="bi bi-shop me-2"></i>Edit Store Data
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

                    <form action="{{ route('store.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $product->name) }}"
                                        placeholder="Product Name" required>
                                    <label for="name"><i class="bi bi-tag me-1"></i>Product Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('store_name') is-invalid @enderror"
                                        id="store_name" name="store_name" value="{{ old('store_name', $product->store_name) }}"
                                        placeholder="Store Name" required>
                                    <label for="store_name"><i class="bi bi-shop-window me-1"></i>Store Name</label>
                                    @error('store_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                    id="category" name="category" value="{{ old('category', $product->category) }}"
                                    placeholder="Category" required>
                                <label for="category"><i class="bi bi-bookmark me-1"></i>Category</label>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea class="form-control @error('desctiption') is-invalid @enderror"
                                    id="desctiption" name="desctiption"
                                    placeholder="Description" style="height: 120px">{{ old('desctiption', $product->desctiption) }}</textarea>
                                <label for="desctiption"><i class="bi bi-card-text me-1"></i>Description</label>
                                @error('desctiption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="photo-section">
                            <h4 class="photo-section-title text-center mb-4">
                                <i class="bi bi-images me-2"></i>Store Photos
                            </h4>

                            <div class="row">
                                @php
                                    $photoFields = [
                                        'booth_photo' => ['Booth Photo', 'bi-shop'],
                                        'menu_photo' => ['Menu Photo', 'bi-card-list'],
                                        'product_photo' => ['Product Photo', 'bi-box'],
                                    ];
                                @endphp

                                @foreach ($photoFields as $field => $info)
                                    <div class="col-md-4 mb-4">
                                        <label for="{{ $field }}" class="form-label">
                                            <i class="bi {{ $info[1] }} me-1"></i>{{ $info[0] }}
                                        </label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error($field) is-invalid @enderror"
                                                id="{{ $field }}" name="{{ $field }}" accept="image/*"
                                                onchange="previewImage(this, '{{ $field }}_preview')">
                                            <label class="input-group-text" for="{{ $field }}">
                                                <i class="bi bi-upload"></i>
                                            </label>
                                        </div>
                                        @error($field)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="preview-container">
                                            @if ($product->{$field})
                                                <img src="{{ asset($product->{$field}) }}" class="preview-image"
                                                    id="{{ $field }}_preview" alt="{{ $info[0] }} Preview">
                                            @else
                                                <img src="" class="preview-image d-none"
                                                    id="{{ $field }}_preview" alt="{{ $info[0] }} Preview">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="button-group mt-4">
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-check-circle me-1"></i>Save Changes
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

    <!-- Preview Image Script -->
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            preview.classList.remove('d-none');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>