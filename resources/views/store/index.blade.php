@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Dagangan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dagangan</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Nama Toko</th>
                        <th>Foto Lapak</th>
                        <th>Foto Menu</th>
                        <th>Foto Produk</th>
                        <th>Kode Lokasi Lapak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->category }}</td>
                        <td>{{ $data->desctiption }}</td>
                        <td>{{ $data->store_name }}</td>
                        <td>
                            <img src="{{ asset($data->booth_photo) }}" class="preview-image" id="booth_preview"
                                alt="Booth Preview" width="100">
                        </td>
                        <td>
                            <img src="{{ asset($data->menu_photo) }}" class="preview-image" id="booth_preview"
                                alt="Booth Preview" width="100">
                        </td>
                        <td>
                            <img src="{{ asset($data->product_photo) }}" class="preview-image" id="booth_preview"
                                alt="Booth Preview" width="100">
                        </td>
                        <td>{{ $data->location_id }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('store.update') }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
