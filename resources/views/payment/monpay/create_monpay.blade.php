<!-- Modal -->
<div class="modal fade" id="createMonthlyPaymentModal" tabindex="-1" aria-labelledby="createMonthlyPaymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMonthlyPaymentModalLabel">Tambah Pembayaran Bulanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('monpay.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                    id="currency" name="currency" value="{{ old('currency') }}" required>
                                <label for="currency">Nominal</label>
                                @error('currency')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" value="{{ old('date') }}" required>
                                <label for="date">Tanggal Transfer</label>
                                @error('date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select @error('month_id') is-invalid @enderror" id="month_id"
                                    name="month_id" required>
                                    <option value="">Pilih Bulan</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month->id }}"
                                            {{ old('month_id') == $month->id ? 'selected' : '' }}>
                                            {{ $month->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="month_id">Bulan</label>
                                @error('month_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Bukti Transfer</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    id="photo" name="photo" accept="image/jpeg,image/png,image/jpg">
                                <div class="form-text">Format: PNG, JPG atau JPEG (Maksimal 2MB)</div>
                                @error('photo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn rounded-pill btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk format currency -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currencyInput = document.getElementById('currency');

        // Format initial value if exists
        if (currencyInput.value) {
            currencyInput.value = formatNumber(currencyInput.value);
        }

        currencyInput.addEventListener('input', function(e) {
            // Remove any non-digit characters
            let value = e.target.value.replace(/\D/g, '');

            // Format the number
            if (value) {
                e.target.value = formatNumber(value);
            }
        });

        // Handle form submission
        currencyInput.form.addEventListener('submit', function(e) {
            // Remove dots before submitting
            currencyInput.value = currencyInput.value.replace(/\./g, '');
        });
    });

    function formatNumber(number) {
        // Convert to string and add thousand separator
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
