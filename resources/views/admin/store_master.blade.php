@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User Approval</h5>
            <div>
                <div class="input-group">
                    <input type="text" class="form-control" id="live-search"
                        placeholder="Search by store name, merchant name, phone, or category" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-primary" type="button" id="clear-search">
                        <i class="bx bx-x"></i> Clear
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Toko</th>
                        <th>Lokasi</th>
                        <th>Nama Penjual</th>
                        <th>No HP</th>
                        <th>Jenis Dagangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="search-results">
                    @forelse($data as $item)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->store_name }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->merchant_name }}</td>
                            <td>{{ $item->merchant_phone }}</td>
                            <td>{{ $item->category }}</td>
                            <td>
                                <a href="{{ route('store-master.detail', $item->id) }}"
                                    class="btn rounded-pill btn-info">Detail</a>
                                <a href="{{ route('users.delete', $item->id) }}"
                                    class="btn rounded-pill btn-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No store data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center my-3" id="pagination-container">
                @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $data->appends(request()->query())->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('live-search');
            const clearButton = document.getElementById('clear-search');
            const searchResults = document.getElementById('search-results');
            const paginationContainer = document.getElementById('pagination-container');
            let debounceTimer;

            // Function to perform live search
            const performSearch = (searchTerm) => {
                // Show loading indicator
                searchResults.innerHTML =
                    '<tr><td colspan="7" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';

                // Make AJAX request to search endpoint
                fetch(`{{ route('store-master.live-search') }}?search=${encodeURIComponent(searchTerm)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Clear previous results
                        searchResults.innerHTML = '';

                        if (data.data.length > 0) {
                            // Populate table with search results
                            data.data.forEach((item, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${(data.current_page - 1) * data.per_page + index + 1}</td>
                            <td>${item.store_name}</td>
                            <td>${item.location_id}</td>
                            <td>${item.merchant_name}</td>
                            <td>${item.merchant_phone}</td>
                            <td>${item.category}</td>
                            <td>
                                <a href="/admin/store-master/detail/${item.id}" class="btn rounded-pill btn-info">Detail</a>
                            </td>
                        `;
                                searchResults.appendChild(row);
                            });

                            // Update pagination
                            paginationContainer.innerHTML = data.pagination;
                        } else {
                            // Show no results message
                            searchResults.innerHTML =
                                '<tr><td colspan="7" class="text-center">No store data found.</td></tr>';
                            paginationContainer.innerHTML = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        searchResults.innerHTML =
                            '<tr><td colspan="7" class="text-center">An error occurred while searching. Please try again.</td></tr>';
                    });
            };

            // Add input event listener with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                const searchTerm = this.value.trim();

                // Debounce to avoid too many requests
                debounceTimer = setTimeout(() => {
                    if (searchTerm.length > 0) {
                        performSearch(searchTerm);
                    } else {
                        // If search is empty, load initial data
                        window.location.href = '{{ route('store-master.index') }}';
                    }
                }, 500); // Wait 500ms after typing stops
            });

            // Clear search button
            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                window.location.href = '{{ route('store-master.index') }}';
            });
        });
    </script>
@endsection
