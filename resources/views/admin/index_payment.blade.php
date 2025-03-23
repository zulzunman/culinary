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
            <!-- Monthly Payments Tab -->
            <div class="tab-pane fade show active" id="monthly-payment">
                <!-- Monthly Filter Form -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-select" id="monthlyMonthFilter">
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
                            <select class="form-select" id="monthlyYearFilter">
                                <option value="">Pilih Tahun</option>
                                @for ($year = date('Y'); $year >= 2020; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <button type="button" class="btn btn-primary me-2" id="applyMonthlyFilter">Filter</button>
                                <button type="button" class="btn btn-secondary" id="resetMonthlyFilter">Reset
                                    Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Monthly Payments Table -->
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pedagang</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="monthlyPaymentTableBody">
                            <!-- Rows will be populated via JavaScript -->
                            <tr class="monthly-initial-message">
                                <td colspan="8" class="text-center">Silakan pilih bulan dan tahun, lalu klik Filter untuk
                                    menampilkan data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Event Payments Tab -->
            <div class="tab-pane fade" id="event-payment">
                <!-- Event Filter Form -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-select" id="eventFilter">
                                <option value="">Pilih Event</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <button type="button" class="btn btn-primary me-2" id="applyEventFilter">Filter</button>
                                <button type="button" class="btn btn-secondary" id="resetEventFilter">Reset
                                    Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Event Payments Table -->
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pedagang</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="eventPaymentTableBody">
                            <!-- Rows will be populated via JavaScript -->
                            <tr class="event-initial-message">
                                <td colspan="8" class="text-center">Silakan pilih event, lalu klik Filter
                                    untuk menampilkan data</td>
                            </tr>
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

        // Data from controller
        const merchantProfiles = @json($merchant_profiles);
        const monthlyPayments = @json($monPays);
        const eventPayments = @json($eventPays);
        const allMonths = @json($months);
        const events =
        @json($events); // Make sure this exists and is correctly passed from the controller

        // Monthly Payment Filter
        const monthlyMonthFilter = document.getElementById('monthlyMonthFilter');
        const monthlyYearFilter = document.getElementById('monthlyYearFilter');
        const applyMonthlyFilterBtn = document.getElementById('applyMonthlyFilter');
        const resetMonthlyFilterBtn = document.getElementById('resetMonthlyFilter');

        // Event Payment Filter
        const eventFilter = document.getElementById('eventFilter');
        const applyEventFilterBtn = document.getElementById('applyEventFilter');
        const resetEventFilterBtn = document.getElementById('resetEventFilter');

        // Function to filter Monthly Payment table
        function filterMonthlyPayments() {
            const selectedMonth = monthlyMonthFilter.value;
            const selectedYear = monthlyYearFilter.value;
            const tbodyElement = document.getElementById('monthlyPaymentTableBody');

            // Clear previous content except initial message
            Array.from(tbodyElement.querySelectorAll('tr:not(.monthly-initial-message)')).forEach(row => {
                row.remove();
            });

            if (!selectedMonth || !selectedYear) {
                document.querySelector('.monthly-initial-message').style.display = '';
                return;
            }

            // Hide initial message
            document.querySelector('.monthly-initial-message').style.display = 'none';

            // Create a mapping between month numbers and month IDs
            const monthMapping = {
                "01": allMonths.find(m => m.name === "Januari")?.id,
                "02": allMonths.find(m => m.name === "Februari")?.id,
                "03": allMonths.find(m => m.name === "Maret")?.id,
                "04": allMonths.find(m => m.name === "April")?.id,
                "05": allMonths.find(m => m.name === "Mei")?.id,
                "06": allMonths.find(m => m.name === "Juni")?.id,
                "07": allMonths.find(m => m.name === "Juli")?.id,
                "08": allMonths.find(m => m.name === "Agustus")?.id,
                "09": allMonths.find(m => m.name === "September")?.id,
                "10": allMonths.find(m => m.name === "Oktober")?.id,
                "11": allMonths.find(m => m.name === "November")?.id,
                "12": allMonths.find(m => m.name === "Desember")?.id
            };

            // Get the month ID from our mapping
            const monthId = monthMapping[selectedMonth];

            if (!monthId) {
                // Create a "No month found" message
                const noMonthRow = document.createElement('tr');
                noMonthRow.innerHTML = '<td colspan="8" class="text-center">Bulan tidak ditemukan</td>';
                tbodyElement.appendChild(noMonthRow);
                return;
            }

            // For each merchant, create a row in the table
            merchantProfiles.forEach((merchant, index) => {
                const row = document.createElement('tr');

                // Find payment for this merchant, month, and year
                const payment = monthlyPayments.find(p => {
                    const paymentYear = new Date(p.created_at).getFullYear();
                    return p.user_id === merchant.user_id &&
                        p.month_id === monthId &&
                        paymentYear === parseInt(selectedYear);
                });

                // Create row with payment data or empty cells
                row.innerHTML = `
        <td>${index + 1}</td>
        <td>${merchant.name}</td>
        <td>${payment ? formatDate(payment.date) : '-'}</td>
        <td>
            ${payment 
                ? `<span class="badge bg-${payment.status === 'Lunas' ? 'success' : 'warning'}">${payment.status}</span>` 
                : '<span class="badge bg-danger">Belum Bayar</span>'}
        </td>
        <td>
            ${payment && payment.photo
                ? `<a href="${asset(payment.photo)}" target="_blank" class="text-primary">Lihat Bukti</a>`
                : '-'}
        </td>
    `;

                tbodyElement.appendChild(row);
            });
        }

        // Function to filter Event Payment table
        function filterEventPayments() {
            const selectedEventId = eventFilter.value;
            const tbodyElement = document.getElementById('eventPaymentTableBody');

            // Clear previous content except initial message
            Array.from(tbodyElement.querySelectorAll('tr:not(.event-initial-message)')).forEach(row => {
                row.remove();
            });

            if (!selectedEventId) {
                document.querySelector('.event-initial-message').style.display = '';
                return;
            }

            // Hide initial message
            document.querySelector('.event-initial-message').style.display = 'none';

            // Get the selected event details
            const selectedEvent = events.find(e => e.id === parseInt(selectedEventId));
            const eventName = selectedEvent ? selectedEvent.name : 'Unknown Event';

            // For debugging
            console.log("Selected Event ID:", selectedEventId);
            console.log("Selected Event:", selectedEvent);
            console.log("Merchant Profiles:", merchantProfiles);
            console.log("Event Payments:", eventPayments);

            // For each merchant, create a row in the table regardless of payment status
            merchantProfiles.forEach((merchant, index) => {
                const row = document.createElement('tr');

                // Find payment for this merchant and event
                const payment = eventPayments.find(p =>
                    p.user_id === merchant.user_id &&
                    p.event_id === parseInt(selectedEventId)
                );

                // Create row with payment data if exists, or empty cells if not
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${merchant.name}</td>
                <td>${payment ? formatDate(payment.date) : '-'}</td>
                <td>${eventName}</td>
                <td>
                    ${payment 
                        ? `<span class="badge bg-${payment.status === 'Lunas' ? 'success' : 'warning'}">${payment.status}</span>` 
                        : '<span class="badge bg-danger">Belum Bayar</span>'}
                </td>
                <td>
                    ${payment && payment.photo
                        ? `<a href="${asset(payment.photo)}" target="_blank" class="text-primary">Lihat Bukti</a>`
                        : '-'}
                </td>
            `;

                tbodyElement.appendChild(row);
            });
        }

        // Helper function to format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Helper function for asset URL
        function asset(path) {
            return path ? path.startsWith('/') ? path : '/' + path : '';
        }

        // Monthly Payment filter event listeners
        applyMonthlyFilterBtn.addEventListener('click', filterMonthlyPayments);
        resetMonthlyFilterBtn.addEventListener('click', function() {
            monthlyMonthFilter.value = '';
            monthlyYearFilter.value = '';
            filterMonthlyPayments();
        });

        // Event Payment filter event listeners
        applyEventFilterBtn.addEventListener('click', filterEventPayments);
        resetEventFilterBtn.addEventListener('click', function() {
            eventFilter.value = '';
            filterEventPayments();
        });
    });
</script>
