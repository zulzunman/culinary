@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        @if ($data)
            <div class="table-responsive text-nowrap">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Merchant</h4>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editMerchantModal{{ $data->id }}">
                            <i class="fas fa-edit me-1"></i> Edit Data Merchant
                        </button>
                    </div>
                </div>

                <table class="table table-hover mb-0">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $data->gender }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>{{ $data->phone }}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>{{ optional($data->city)->name }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>{{ optional($data->religion)->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <td>Foto KTP</td>
                            <td>
                                <img src="{{ asset($data->ktp_picture) }}" class="preview-image" id="ktp_preview"
                                    alt="KTP Preview" width="100">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal for each merchant -->
            <div class="modal fade" id="editMerchantModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
                @include('merchant.edit', [
                    'merchantProfile' => $data,
                    'religions ' => $religions,
                    'cities' => $cities,
                ])
            </div>
        @else
            <div class="card-body">
                <div class="alert alert-info text-center">
                    Tidak ada data merchant ditemukan.
                </div>
            </div>
        @endif
    </div>
@endsection
