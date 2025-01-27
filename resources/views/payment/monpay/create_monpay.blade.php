<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Monthly Payment</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('monpay.add') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Currency Amount</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('currency') is-invalid @enderror"
                                    name="currency" value="{{ old('currency') }}" required>
                                @error('currency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Payment Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    name="date" value="{{ old('date') }}" required>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="month_id" class="col-md-4 col-form-label text-md-right">Month</label>
                            <div class="col-md-6">
                                <select name="month_id" class="form-control @error('month_id') is-invalid @enderror" required>
                                    <option value="">Select Month</option>
                                    @foreach($months as $month)
                                        <option value="{{ $month->id }}" {{ old('month_id') == $month->id ? 'selected' : '' }}>
                                            {{ $month->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('month_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Payment Proof</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    name="photo" accept="image/jpeg,image/png,image/jpg">
                                <small class="text-muted">Max file size: 2MB (JPG, JPEG, PNG)</small>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit Payment
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
