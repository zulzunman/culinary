<!-- Modal -->
<div class="modal fade" id="createEventPaymentModal" tabindex="-1" aria-labelledby="createEventPaymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventPaymentModalLabel">Tambah Pembayaran Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('eventpay.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select @error('event_id') is-invalid @enderror" id="event_id"
                                    name="event_id" required>
                                    <option value="">Pilih Event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}"
                                            {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="event_id">Event</label>
                                @error('event_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                    id="currency" name="currency"
                                    value="{{ number_format(old('currency') ?? 0, 0, ',', '.') }}" required>
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const currencyInput = document.getElementById('currency');

        function formatRupiah(angka) {
            // Pastikan angka adalah string
            let numberString = angka.toString();

            // Hapus semua karakter kecuali angka
            let number = numberString.replace(/[^\d]/g, '');

            // Format dengan titik sebagai pemisah ribuan
            return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Format saat input
        currencyInput.addEventListener('input', function(e) {
            // Simpan posisi kursor
            let cursorPosition = this.selectionStart;

            // Format angka
            this.value = formatRupiah(this.value);

            // Kembalikan posisi kursor
            this.setSelectionRange(cursorPosition, cursorPosition);
        });

        // Sebelum submit, hapus titik
        currencyInput.closest('form').addEventListener('submit', function() {
            currencyInput.value = currencyInput.value.replace(/\./g, '');
        });
    });
</script> --}}
