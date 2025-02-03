@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="table-responsive text-nowrap">
            <h5 class="card-header">Merchant Details</h5>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Data Pedagang</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>NIK</td>
                        <td>{{ $merchant->nik }}</td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>{{ $merchant->name }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>{{ $merchant->gender }}</td>
                    </tr>
                    <tr>
                        <td>Nomor HP</td>
                        <td>{{ $merchant->phone }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>{{ $merchant->religion->name }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>{{ $merchant->city->name }}, {{ $merchant->date }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $merchant->address }}</td>
                    </tr>
                    <tr>
                        <td>Foto KTP</td>
                        <td>
                            <img src="{{ asset($merchant->ktp_picture) }}" class="img-fluid" style="max-width: 100px;"
                                alt="KTP Picture">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="table-responsive text-nowrap">
            <h5 class="card-header">Data Toko</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Store Details</th>
                        <th>Information</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>Nama Toko</td>
                        <td>{{ $product->store_name }}</td>
                    </tr>
                    <tr>
                        <td>Nama Dagangan</td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Dagangan</td>
                        <td>{{ $product->category }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi Dagangan</td>
                        <td>{{ $product->desctiption }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>{{ $product->location->code }}</td>
                    </tr>
                    <tr>
                        <td>Foto Lapak</td>
                        <td>
                            <img src="{{ asset($product->booth_photo) }}" class="img-fluid" style="max-width: 100px;"
                                alt="Booth Photo">
                        </td>
                    </tr>
                    <tr>
                        <td>Foto Menu</td>
                        <td>
                            <img src="{{ asset($product->menu_photo) }}" class="img-fluid" style="max-width: 100px;"
                                alt="Menu Photo">
                        </td>
                    </tr>
                    <tr>
                        <td>Foto Produk</td>
                        <td>
                            <img src="{{ asset($product->product_photo) }}" class="img-fluid" style="max-width: 100px;"
                                alt="Product Photo">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('store-master.index') }}" class="btn rounded-pill btn-success">Back</a>
    </div>
@endsection
