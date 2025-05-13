@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid px-4 py-5">
        @if (auth()->user()->email === 'superadmin@example.com' || auth()->user()->email === 'admin@example.com')
            {{-- Admin & Super Admin View - Approve Users --}}
            <div class="row g-4">
                @forelse($users as $user)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm profile-card">
                            <div class="card-body">
                                <div class="profile-details">
                                    <div class="detail-item">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="fw-medium">{{ $user->username }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="bx bx-envelope me-2"></i>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-store me-2"></i>
                                        <span>{{ $user->merchant->product->store_name }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class='bx bx-food-menu me-2'></i>
                                        <span>{{ $user->merchant->product->desctiption }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="bx bx-check-circle me-2"></i>
                                        <span>Status: {{ $user->status }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light px-3 py-2">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('users.approve', $user->id) }}" class="btn btn-success flex-grow-1">
                                        <i class="bx bx-check me-1"></i> Approve
                                    </a>
                                    <button type="button" class="btn btn-danger flex-grow-1" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal{{ $user->id }}">
                                        <i class="bx bx-x me-1"></i> Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Include rejection modal for each user --}}
                    <div class="modal fade" id="rejectModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="rejectModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel{{ $user->id }}">Reject User:
                                        {{ $user->username }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('users.reject', $user->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="redirect_to" value="{{ route('dashboard') }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="comment{{ $user->id }}" class="form-label">Pesan
                                                penolakan</label>
                                            <textarea class="form-control" name="comment" id="comment{{ $user->id }}" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Submit Rejection</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <i class="bx bx-info-circle me-2"></i>
                            No pending users found.
                        </div>
                    </div>
                @endforelse
            </div>
        @else
            {{-- Regular User View - Welcome Dashboard --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="fw-bold mb-0">Welcome Dashboard!</h6>
                </div>
                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->username }}! This is your dashboard.</p>
                    {{-- Add more dashboard content for regular users here --}}
                </div>
            </div>
        @endif
    </div>

    <style>
        .profile-card {
            transition: transform 0.2s ease;
        }

        .profile-card:hover {
            transform: translateY(-3px);
        }

        .profile-details .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            color: #6c757d;
        }

        .profile-details .detail-item i {
            color: #6c757d;
            font-size: 1.1rem;
            width: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
        }

        .btn i {
            font-size: 1.1rem;
        }
    </style>
@endsection
