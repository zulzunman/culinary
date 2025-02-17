@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="monthly-payment-tab" data-bs-toggle="tab" href="#monthly-payment">
                        Pembayaran Bulanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="event-payment-tab" data-bs-toggle="tab" href="#event-payment">
                        Pembayaran Event
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <!-- Filter Form -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select class="form-select" id="monthFilter">
                            <option value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="yearFilter">
                            <option value="">Pilih Tahun</option>
                            @for ($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" id="applyFilter">Filter</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-secondary" id="resetFilter">Reset Filter</button>
                    </div>
                </div>
            </div>
            <!-- Monthly Payments Tab -->
            <div class="tab-pane fade show active" id="monthly-payment">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Tanggal Dibuat</th>
                                <th>Bulan</th>
                                <th>User</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="monthlyPaymentTableBody">
                            @foreach ($monPays as $index => $payment)
                                <tr class="payment-row" data-created="{{ date('Y-m-d', strtotime($payment->created_at)) }}"
                                    style="display: none;">
                                    <td class="row-number">{{ $index + 1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($payment->date)) }}</td>
                                    <td class="created-date">{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                                    <td>{{ $payment->month->name }}</td>
                                    <td>{{ $payment->merchant_name }}</td>
                                    <td>Rp
                                        {{ number_format((float) str_replace(['Rp', '.', ','], '', $payment->currency), 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status === 'Lunas' ? 'success' : 'warning' }}">
                                            {{ $payment->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ asset($payment->photo) }}" target="_blank" class="text-primary">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="initial-message">
                                <td colspan="8" class="text-center">Silakan pilih bulan dan tahun, lalu klik Filter untuk
                                    menampilkan data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Event Payments Tab -->
            <div class="tab-pane fade" id="event-payment">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Tanggal Dibuat</th>
                                <th>Event</th>
                                <th>User</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="eventPaymentTableBody">
                            @foreach ($eventPays as $index => $payment)
                                <tr class="payment-row"
                                    data-created="{{ date('Y-m-d', strtotime($payment->created_at)) }}">
                                    <td class="row-number">{{ $index + 1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($payment->date)) }}</td>
                                    <td class="created-date">{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                                    <td>{{ $payment->event->name }}</td>
                                    <td>{{ $payment->merchant_name }}</td>
                                    <td>Rp
                                        {{ number_format((float) str_replace(['Rp', '.', ','], '', $payment->currency), 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status === 'Lunas' ? 'success' : 'warning' }}">
                                            {{ $payment->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ asset($payment->photo) }}" target="_blank" class="text-primary">
                                            Lihat Bukti
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab handling
        let hash = window.location.hash;
        if (hash) {
            let tab = document.querySelector(`a[href="${hash}"]`);
            if (tab) {
                tab.click();
            }
        }
        let tabs = document.querySelectorAll('.nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                history.pushState(null, null, e.target.getAttribute('href'));
            });
        });
        // Get filter elements
        const monthFilter = document.getElementById('monthFilter');
        const yearFilter = document.getElementById('yearFilter');
        const applyFilterBtn = document.getElementById('applyFilter');
        const resetFilterBtn = document.getElementById('resetFilter');
        // Filter function
        function filterPayments() {
            const selectedMonth = monthFilter.value;
            const selectedYear = yearFilter.value;
            // Filter both tables
            filterTable('monthlyPaymentTableBody', selectedMonth, selectedYear);
            filterTable('eventPaymentTableBody', selectedMonth, selectedYear);
        }
        // Function to filter individual table
        function filterTable(tableId, selectedMonth, selectedYear) {
            const tbody = document.getElementById(tableId);
            if (!tbody) return;
            const rows = tbody.getElementsByClassName('payment-row');
            const initialMessage = tbody.querySelector('.initial-message');
            let visibleCount = 0;
            let hasVisibleRows = false;
            // Hide initial message if filter is applied
            if (selectedMonth || selectedYear) {
                if (initialMessage) initialMessage.style.display = 'none';
            } else {
                if (initialMessage) initialMessage.style.display = '';
                // Hide all rows and return if no filter is applied
                Array.from(rows).forEach(row => row.style.display = 'none');
                return;
            }
            for (let row of rows) {
                const createdDate = row.getAttribute('data-created');
                const [rowYear, rowMonth] = createdDate.split('-');
                const monthMatch = !selectedMonth || rowMonth === selectedMonth;
                const yearMatch = !selectedYear || rowYear === selectedYear;
                if (monthMatch && yearMatch) {
                    row.style.display = '';
                    visibleCount++;
                    row.querySelector('.row-number').textContent = visibleCount;
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            }
            // Handle no data message
            const noDataRow = tbody.querySelector('.no-data-message');
            if (!hasVisibleRows && (selectedMonth || selectedYear)) {
                if (!noDataRow) {
                    const messageRow = document.createElement('tr');
                    messageRow.className = 'no-data-message';
                    messageRow.innerHTML =
                        '<td colspan="8" class="text-center">Tidak ada data yang sesuai dengan filter</td>';
                    tbody.appendChild(messageRow);
                }
                if (initialMessage) initialMessage.style.display = 'none';
            } else if (noDataRow) {
                noDataRow.remove();
            }
        }
        // Add event listener for filter button
        applyFilterBtn.addEventListener('click', filterPayments);
        // Reset filters
        resetFilterBtn.addEventListener('click', function() {
            monthFilter.value = '';
            yearFilter.value = '';
            filterPayments();
        });
        // Initial state - hide all rows
        filterPayments();
    });
</script>
