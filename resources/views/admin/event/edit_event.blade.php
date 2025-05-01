{{-- Edit Modal --}}
<div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editEventModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel{{ $event->id }}">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('event.edit', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name{{ $event->id }}" class="form-label">Event Name<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name{{ $event->id }}" name="name" value="{{ old('name', $event->name) }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="proposal{{ $event->id }}" class="form-label">Proposal (PDF)</label>
                        <input type="file" class="form-control @error('proposal') is-invalid @enderror"
                            id="proposal{{ $event->id }}" name="proposal" accept=".pdf">
                        <small class="text-muted">Leave empty if you don't want to change the proposal file</small>
                        @if ($event->proposal)
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn rounded-pill btn-primary">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteEventModal{{ $event->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteEventModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEventModalLabel{{ $event->id }}">Delete Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the event "{{ $event->name }}"?
            </div>
            <div class="modal-footer">
                <form action="{{ route('event.delete', $event->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn rounded-pill btn-danger">Delete Event</button>
                </form>
            </div>
        </div>
    </div>
</div>
