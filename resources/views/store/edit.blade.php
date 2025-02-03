<div class="modal fade"id="editModal{{ $data->id }}" tabindex="-1" aria-labelledby="editStoreModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStoreModalLabel">Edit Store Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store.edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label required">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $data->name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="store_name" class="form-label required">Store Name</label>
                            <input type="text" class="form-control" id="store_name" name="store_name"
                                value="{{ old('store_name', $data->store_name) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label required">Category</label>
                            <input type="text" class="form-control" id="category" name="category"
                                value="{{ old('category', $data->category) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="desctiption" class="form-label">Description</label>
                        <textarea class="form-control" id="desctiption" name="desctiption" rows="3">{{ old('desctiption', $data->desctiption) }}</textarea>
                    </div>

                    <div class="row">
                        @php
                            $photoFields = [
                                'booth_photo' => 'Booth Photo',
                                'menu_photo' => 'Menu Photo',
                                'product_photo' => 'Product Photo',
                            ];
                        @endphp

                        @foreach ($photoFields as $field => $label)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                    <div class="position-relative">
                                        <input type="file"
                                            class="form-control @error('{{ $field }}') is-invalid @enderror"
                                            id="{{ $field }}" name="{{ $field }}" accept="image/*"
                                            onchange="previewImage(this, '{{ $field }}_preview')">

                                        @error('{{ $field }}')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        @if ($data->{$field})
                                            <img src="{{ asset($data->{$field}) }}" class="img-thumbnail mt-2"
                                                id="{{ $field }}_preview" alt="{{ $label }} Preview"
                                                style="max-height: 200px; object-fit: cover;">
                                        @else
                                            <img src="" class="img-thumbnail mt-2 d-none"
                                                id="{{ $field }}_preview" alt="{{ $label }} Preview"
                                                style="max-height: 200px; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn rounded-pill btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
