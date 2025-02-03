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
                        Pertama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="monthly-payment-tab" data-bs-toggle="tab" href="#monthly-payment">Pembayaran
                        Bulanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="acara-payment-tab" data-bs-toggle="tab" href="#acara-payment">Pembayaran
                        Acara</a>
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
                                <th>nominal</th>
                                <th>tanggal tf</th>
                                <th>bukti tf</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>1</td>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pembayaran Bulanan Tab -->
            <div class="tab-pane fade" id="monthly-payment">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createMonthlyPaymentModal">
                            Tambah Pembayaran Bulanan
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>nominal</th>
                                    <th>tanggal tf</th>
                                    <th>bukti tf</th>
                                    <th>bulan</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse($monPays as $monPay)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $monPay->currency }}</td>
                                        <td>{{ $monPay->date }}</td>
                                        <td>{{ $monPay->photo }}</td>
                                        <td>{{ $monPay->month->name }}</td>
                                        <td>{{ $monPay->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No pending users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('payment.monpay.create_monpay', ['months' => $months])

            <div class="tab-pane fade" id="acara-payment">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createEventPaymentModal">
                            Tambah Pembayaran Event
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>nominal</th>
                                    <th>tanggal tf</th>
                                    <th>bukti tf</th>
                                    <th>nama acara</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse($eventPays as $eventPay)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $eventPay->currency }}</td>
                                        <td>{{ $eventPay->date }}</td>
                                        <td>{{ $eventPay->photo }}</td>
                                        <td>{{ $eventPay->event->name }}</td>
                                        <td>{{ $eventPay->status }}</td>
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
            </div>
        </div>
        @include('payment.eventpay.create_eventpay', ['events' => $events])
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
