@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user-approval">User Approval</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="first-payment-tab" data-bs-toggle="tab" href="#first-payment">Pembayaran
                        Pertama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="payment-approval-tab" data-bs-toggle="tab" href="#payment-approval">Pembayaran
                        Bayaran Approval</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="payment-approval-tab" data-bs-toggle="tab" href="#payment-event">Pembayaran
                        Bayaran Event</a>
                </li>
            </ul>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="tab-content">
            <!-- User Approval Tab -->
            <div class="tab-pane fade show active" id="user-approval">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        <a href="{{ route('users.approve', $user->id) }}"
                                            class="btn rounded-pill btn-success">Approve</a>
                                        <a href="{{ route('users.reject', $user->id) }}"
                                            class="btn rounded-pill btn-danger">Reject</a>
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

            <!-- Pembayaran Pertama Tab -->
            <div class="tab-pane fade" id="first-payment">
                <div class="table-responsive text-nowrap">
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
                                            class="btn rounded-pill btn-success">Approve</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No pending payments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pembayaran Bayaran Approval Tab -->
            <div class="tab-pane fade" id="payment-approval">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Nominal</th>
                                <th>Tanggal Tf</th>
                                <th>Bukti Tf</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($monPays as $monPay)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $monPay->merchant_name }}</td>
                                    <td>{{ $monPay->currency }}</td>
                                    <td>{{ $monPay->date }}</td>
                                    <td>{{ $monPay->photo }}</td>
                                    <td>{{ $monPay->status }}</td>
                                    <td>
                                        <a href="{{ route('monpays.approve', $monPay->id) }}"
                                            class="btn rounded-pill btn-success">Approve</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No pending payments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="payment-event">
                <div class="table-responsive text-nowrap">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Nominal</th>
                                <th>Tanggal Tf</th>
                                <th>Bukti Tf</th>
                                <th>Acara</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($eventPays as $eventPay)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $eventPay->merchant_name }}</td>
                                    <td>{{ $eventPay->currency }}</td>
                                    <td>{{ $eventPay->date }}</td>
                                    <td>{{ $eventPay->photo }}</td>
                                    <td>{{ $eventPay->event->name }}</td>
                                    <td>{{ $eventPay->status }}</td>
                                    <td>
                                        <a href="{{ route('eventpays.approve', $eventPay->id) }}"
                                            class="btn btn-success btn-sm">Approve</a>
                                        <!-- <a href="{{ route('monpays.reject', $iPay->id) }}" class="btn btn-danger btn-sm">Reject</a> -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No pending users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the tab from URL if present
            let hash = window.location.hash;
            if (hash) {
                let tab = document.querySelector(`a[href="${hash}"]`);
                if (tab) {
                    tab.click();
                }
            }

            // Update URL when tab changes
            let tabs = document.querySelectorAll('.nav-link');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    history.pushState(null, null, e.target.getAttribute('href'));
                });
            });
        });
    </script>
@endsection
