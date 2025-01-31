<!-- resources/views/locations/upload.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Upload Locations</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Location Data</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('locations.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="location_file" class="form-label">Choose CSV File</label>
                                <input type="file" class="form-control" id="location_file" name="location_file" accept=".csv,.txt">
                                @error('location_file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Upload and Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
