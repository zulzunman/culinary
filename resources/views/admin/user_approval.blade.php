// user approval view

@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="first-payment-tab" data-bs-toggle="tab" href="#first-payment">Pembayaran
                        Registrasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="payment-approval-tab" data-bs-toggle="tab" href="#payment-approval">Pembayaran
                        Bulanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="payment-approval-tab" data-bs-toggle="tab" href="#payment-event">Pembayaran
                        Event</a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- Pembayaran Pertama Tab -->
            <div class="tab-pane fade show active" id="first-payment">
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
                                    <td>
                                        @if ($iPay->photo)
                                            <img src="{{ asset($iPay->photo) }}" class="preview-image" id="booth_preview"
                                                alt="Transfer Proof" width="100">
                                        @else
                                            No image available
                                        @endif
                                    </td>
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

            <!-- Pembayaran Bulanan Approval Tab -->
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
                            @php
                                // Convert collection to array and sort by date
                                $sortedPayments = $monPays->sortBy(function ($payment) {
                                    return strtotime($payment->date);
                                });
                            @endphp

                            @forelse($sortedPayments as $monPay)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $monPay->merchant_name }}</td>
                                    <td>{{ $monPay->currency }}</td>
                                    <td>{{ date('d-m-Y', strtotime($monPay->date)) }}</td>
                                    <td>
                                        @if ($monPay->photo)
                                            <img src="{{ asset($monPay->photo) }}" class="preview-image" id="booth_preview"
                                                alt="Transfer Proof" width="100">
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                    <td>{{ $monPay->status }}</td>
                                    <td>
                                        <a href="{{ route('monpays.approve', $monPay->id) }}"
                                            class="btn rounded-pill btn-success btn-sm">Approve</a>
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

            <!-- Pembayaran Event Approval Tab -->
            <div class="tab-pane fade" id="payment-event">
                <div class="table-responsive text-nowrap">
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
                                    <td>
                                        @if ($eventPay->photo)
                                            <img src="{{ asset($eventPay->photo) }}" class="preview-image"
                                                id="booth_preview" alt="Transfer Proof" width="100">
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                    <td>{{ $eventPay->event->name }}</td>
                                    <td>{{ $eventPay->status }}</td>
                                    <td>
                                        <a href="{{ route('eventpays.approve', $eventPay->id) }}"
                                            class="btn rounded-pill btn-success btn-sm">Approve</a>
                                        {{-- <!-- <a href="{{ route('monpays.reject', $iPay->id) }}" class="btn btn-danger btn-sm">Reject</a> --> --}}
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
