@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        @forelse($data as $merchant)
            <div class="table-responsive text-nowrap">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Merchant</h4>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editMerchantModal{{ $merchant->id }}">
                            <i class="fas fa-edit me-1"></i> Edit Data Merchant
                        </button>
                    </div>
                </div>

                <table class="table table-hover mb-0">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $merchant->name }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $merchant->nik }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $merchant->gender }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>{{ $merchant->phone }}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>{{ optional($merchant->city)->name }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>{{ optional($merchant->religion)->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $merchant->address }}</td>
                        </tr>
                        <tr>
                            <td>Foto KTP</td>
                            <td>
                                <img src="{{ asset($merchant->ktp_picture) }}" class="preview-image" id="ktp_preview"
                                    alt="KTP Preview" width="100">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal for each merchant -->
            <div class="modal fade" id="editMerchantModal{{ $merchant->id }}" tabindex="-1" aria-hidden="true">
                @include('merchant.edit', [
                    'merchantProfile' => $merchant,
                    'religions ' => $religions,
                    'cities' => $cities,
                ])
            </div>
        @empty
            <div class="card-body">
                <div class="alert alert-info text-center">
                    Tidak ada data merchant ditemukan.
                </div>
            </div>
        @endforelse
    </div>
@endsection
