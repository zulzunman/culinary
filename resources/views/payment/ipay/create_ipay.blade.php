<div class="container">
    <h2>Initial Payment Form</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('ipay.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Currency</label>
            <input type="number" name="currency" id="" required>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Payment Photo</label>
            <input type="file" name="photo" class="form-control-file" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
