<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Events List</h3>
                    @auth
                        @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                            <div class="card-tools">
                                <a href="{{ route('event.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create New Event
                                </a>
                            </div>
                        @endif
                    @endauth
                    <div class="form-group mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Event Name</th>
                                    <th>Proposal</th>
                                    <th>Created At</th>
                                    @auth
                                        @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                                            <th>Action</th>
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
                                            <a href="{{ asset($event->proposal) }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-file-pdf"></i> View Proposal
                                            </a>
                                        </td>
                                        <td>{{ $event->created_at->format('d M Y H:i') }}</td>
                                        @auth
                                            @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                                                <td>
                                                    <a href="{{ route('event.update', $event->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit">Edit</i>
                                                    </a>
                                                    <form action="#" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this event?')">
                                                            <i class="fas fa-trash">Hapus</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endauth
                                    </tr>
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
