<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Event</h3>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('event.edit', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <div class="form-group mb-3">
                            <label for="name">Event Name<span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $event->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="proposal">Proposal (PDF)</label>
                            <input type="file"
                                   class="form-control @error('proposal') is-invalid @enderror"
                                   id="proposal"
                                   name="proposal"
                                   accept=".pdf">
                            <small class="text-muted">Leave empty if you don't want to change the proposal file</small>
                            @if($event->proposal)
                                <div class="mt-2">
                                    <p>Current proposal:
                                        <a href="{{ asset($event->proposal) }}" target="_blank">
                                            View Current Proposal
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @error('proposal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Event</button>
                            <a href="{{ route('event.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
