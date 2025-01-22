<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
        .required::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Product</h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('store.edit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label required">Product Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $product->name) }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="store_name" class="form-label required">Store Name</label>
                                <input type="text"
                                       class="form-control @error('store_name') is-invalid @enderror"
                                       id="store_name"
                                       name="store_name"
                                       value="{{ old('store_name', $product->store_name) }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label required">Category</label>
                                <input type="text"
                                       class="form-control @error('category') is-invalid @enderror"
                                       id="category"
                                       name="category"
                                       value="{{ old('category', $product->category) }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="desctiption" class="form-label">Description</label>
                                <textarea class="form-control @error('desctiption') is-invalid @enderror"
                                          id="desctiption"
                                          name="desctiption"
                                          rows="4">{{ old('desctiption', $product->desctiption) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="location_id" class="form-label required">Location</label>
                                <select class="form-select @error('location_id') is-invalid @enderror"
                                        id="location_id"
                                        name="location_id"
                                        required>
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ old('location_id', $product->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="booth_photo" class="form-label">Booth Photo</label>
                                        <input type="file"
                                               class="form-control @error('booth_photo') is-invalid @enderror"
                                               id="booth_photo"
                                               name="booth_photo"
                                               accept="image/*"
                                               onchange="previewImage(this, 'booth_preview')">
                                        @if($product->booth_photo)
                                            <img src="{{ asset($product->booth_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview">
                                        @else
                                            <img src=""
                                                 class="preview-image d-none"
                                                 id="booth_preview"
                                                 alt="Booth Preview">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="menu_photo" class="form-label">Menu Photo</label>
                                        <input type="file"
                                               class="form-control @error('menu_photo') is-invalid @enderror"
                                               id="menu_photo"
                                               name="menu_photo"
                                               accept="image/*"
                                               onchange="previewImage(this, 'menu_preview')">
                                        @if($product->menu_photo)
                                            <img src="{{ asset($product->menu_photo) }}"
                                                 class="preview-image"
                                                 id="menu_preview"
                                                 alt="Menu Preview">
                                        @else
                                            <img src=""
                                                 class="preview-image d-none"
                                                 id="menu_preview"
                                                 alt="Menu Preview">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="product_photo" class="form-label">Product Photo</label>
                                        <input type="file"
                                               class="form-control @error('product_photo') is-invalid @enderror"
                                               id="product_photo"
                                               name="product_photo"
                                               accept="image/*"
                                               onchange="previewImage(this, 'product_preview')">
                                        @if($product->product_photo)
                                            <img src="{{ asset($product->product_photo) }}"
                                                 class="preview-image"
                                                 id="product_preview"
                                                 alt="Product Preview">
                                        @else
                                            <img src=""
                                                 class="preview-image d-none"
                                                 id="product_preview"
                                                 alt="Product Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('store.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
