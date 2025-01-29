<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create Event Payment</h4>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('eventpay.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="event_id">Select Event<span class="text-danger">*</span></label>
                            <select name="event_id" class="form-control @error('event_id') is-invalid @enderror"
                                required>
                                <option value="">Choose Event</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}"
                                        {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                        {{ $event->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('event_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="currency">Amount<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('currency') is-invalid @enderror"
                                    name="currency" value="{{ old('currency') }}" placeholder="Enter amount" required>
                            </div>
                            @error('currency')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="date">Payment Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror"
                                name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="photo">Payment Proof<span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                name="photo" accept="image/jpeg,image/png,image/jpg" required>
                            <small class="text-muted">Maximum file size: 2MB (JPG, JPEG, PNG)</small>
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                Submit Payment
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Preview image before upload
        document.querySelector('input[name="photo"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2048 * 1024) {
                    alert('File size must be less than 2MB');
                    this.value = '';
                }
            }
        });
    </script>
@endpush
