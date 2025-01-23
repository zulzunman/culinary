@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card-body">
        <div class="table-responsive">
            <div class="container mt-5">
                <h1 class="mb-4">User Approval</h1>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <a href="{{ route('users.approve', $user->id) }}"
                                        class="btn btn-success btn-sm">Approve</a>
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
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
