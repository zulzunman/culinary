@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="table-responsive text-nowrap">
            <h5 class="card-header">User Approval</h5>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('users.approve', $user->id) }}" class="btn btn-success btn-sm">Approve</a>
                                <a href="{{ route('users.reject', $user->id) }}" class="btn btn-danger btn-sm">Reject</a>
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
    <div class="card">
        <div class="table-responsive text-nowrap">
            <h5 class="card-header">Pembayaran Pertama</h5>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Nominal</th>
                        <th>Tanggal Tf</th>
                        <th>Bukti Tf</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($iPays as $iPay)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $iPay->merchant_name }}</td>
                            <td>{{ $iPay->currency }}</td>
                            <td>{{ $iPay->date }}</td>
                            <td>{{ $iPay->photo }}</td>
                            <td>{{ $iPay->status }}</td>
                            <td>
                                <a href="{{ route('ipays.approve', $iPay->id) }}"
                                    class="btn btn-success btn-sm">Approve</a>
                                <!-- <a href="{{ route('ipays.reject', $iPay->id) }}" class="btn btn-danger btn-sm">Reject</a> -->
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
