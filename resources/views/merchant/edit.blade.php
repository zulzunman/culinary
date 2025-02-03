<div class="modal fade" id="editMerchantModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Merchant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('merchant.edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nik" name="nik"
                                    value="{{ $merchantProfile->nik }}">
                                <label for="nik">NIK</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $merchantProfile->name }}">
                                <label for="name">Nama Lengkap</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline mt-2">
                                <input type="radio" class="form-check-input" name="gender" value="Laki - laki"
                                    id="male" {{ $merchantProfile->gender == 'Laki - laki' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="gender" value="Perempuan"
                                    id="female" {{ $merchantProfile->gender == 'Perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Perempuan</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="{{ $merchantProfile->phone }}">
                                <label for="phone">Nomor Telepon</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ $merchantProfile->date }}">
                                <label for="date">Tanggal Lahir</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="religion_id" name="religion_id">
                                    <option value="">Pilih Agama</option>
                                    @foreach ($religions as $religion)
                                        <option value="{{ $religion->id }}"
                                            {{ $merchantProfile->religion_id == $religion->id ? 'selected' : '' }}>
                                            {{ $religion->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="religion_id">Agama</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="city_id" name="city_id">
                                    <option value="">Pilih Kota</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ $merchantProfile->city_id == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="city_id">Kota</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="address" name="address" style="height: 100px">{{ $merchantProfile->address }}</textarea>
                                <label for="address">Alamat</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Foto KTP</label>
                            @if ($merchantProfile->ktp_picture)
                                <div class="mb-3">
                                    <img src="{{ asset($merchantProfile->ktp_picture) }}" alt="KTP"
                                        class="d-block rounded" height="100">
                                </div>
                            @endif
                            <input type="file" class="form-control" name="ktp_picture"
                                accept="image/jpeg,image/png,image/jpg">
                            <div class="form-text">PNG, JPG atau JPEG (MAX. 2MB)</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn rounded-pill btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
