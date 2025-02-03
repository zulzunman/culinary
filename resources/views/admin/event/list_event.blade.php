@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Events List</h4>
                                @auth
                                    @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                                        <div class="ms-auto">
                                            <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#createEventModal">
                                                <i class="fas fa-plus me-1"></i> Create New Event
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="events-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Event Name</th>
                                            <th>Proposal</th>
                                            <th>Created At</th>
                                            @auth
                                                @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                                                    <th>Actions</th>
                                                @endif
                                            @endauth
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($events as $event)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $event->name }}</td>
                                                <td>
                                                    <a href="{{ asset($event->proposal) }}" target="_blank"
                                                        class="btn rounded-pill btn-info btn-sm">
                                                        <i class="fas fa-file-pdf me-1"></i> View Proposal
                                                    </a>

                                                </td>
                                                <td>{{ $event->created_at->format('d M Y H:i') }}</td>
                                                @auth
                                                    @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                                                        <td>
                                                            <button type="button" class="btn rounded-pill btn-warning btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editEventModal{{ $event->id }}">
                                                                <i class="fas fa-edit me-1"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn rounded-pill btn-danger btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteEventModal{{ $event->id }}">
                                                                <i class="fas fa-trash me-1"></i> Delete
                                                            </button>
                                                        </td>
                                                    @endif
                                                @endauth
                                            </tr>
                                            @include('admin.event.edit_event', ['event' => $event])
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No events found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Create Modal --}}
    @auth
        @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
            @include('admin.event.create_event')
        @endif
    @endauth
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#events-table').DataTable();
        });

        // Handle form errors
        @if ($errors->any())
            @if (old('event_id'))
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('editEventModal{{ old('event_id') }}'));
                    modal.show();
                });
            @else
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('createEventModal'));
                    modal.show();
                });
            @endif
        @endif
    </script>
@endpush
