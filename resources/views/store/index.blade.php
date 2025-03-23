@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Toko</h3>
            <div class="d-flex gap-2">
                <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                    data-bs-target="#editModal{{ $data->id }}">
                    <i class="fas fa-edit me-1"></i> Edit Data Toko
                </button>
                <a href="{{ route('store.print') }}" class="btn rounded-pill btn-primary">
                    <i class="fas fa-print me-1"></i> Cetak
                </a>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover mb-0">
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>Nama Dagangan</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $data->category }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>{{ $data->desctiption }}</td>
                    </tr>
                    <tr>
                        <td>Nama Toko</td>
                        <td>{{ $data->store_name }}</td>
                    </tr>
                    <tr>
                        <td>Kode Lokasi Lapak</td>
                        <td>{{ $data->location->code }}</td>
                    </tr>
                    <tr>
                        <td>Foto Lapak</td>
                        <td>
                            <img src="{{ asset($data->booth_photo) }}" class="preview-image" id="booth_preview"
                                alt="Booth Preview" width="100">
                        </td>
                    </tr>
                    <tr>
                        <td>Foto Menu</td>
                        <td>
                            <img src="{{ asset($data->menu_photo) }}" class="preview-image" id="menu_preview"
                                alt="Menu Preview" width="100">
                        </td>
                    </tr>
                    <tr>
                        <td>Foto Produk</td>
                        <td>
                            <img src="{{ asset($data->product_photo) }}" class="preview-image" id="product_preview"
                                alt="Product Preview" width="100">
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('store.edit', ['Product' => $data])
        </div>
    </div>
@endsection
