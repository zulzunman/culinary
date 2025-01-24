@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Biodata</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Religion</th>
                        <th>City</th>
                        <th>date</th>
                        <th>Address</th>
                        <th>KTP</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->religion_id }}</td>
                            <td>{{ $item->city_id }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->ktp_picture }}</td>
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
