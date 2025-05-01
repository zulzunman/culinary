@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="table-responsive text-nowrap">
            <h5 class="card-header">Data Toko</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Toko</th>
                        <th>Lokasi</th>
                        <th>Nama Penjual</th>
                        <th>No HP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->store_name }}</td>
                            <td>{{ $item->location_id }}</td>
                            <td>{{ $item->merchant_name }}</td>
                            <td>{{ $item->merchant_phone }}</td>
                            <td>
                                <a href="{{ route('store-master.detail', $item->id) }}"
                                    class="btn rounded-pill btn-info">Detail</a>
                                <a href="{{ route('users.delete', $item->id) }}"
                                    class="btn rounded-pill btn-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No pending users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
