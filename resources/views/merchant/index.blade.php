<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="{{ route('merchant.update') }}" class="btn btn-success btn-sm">Edit Biodata</a>
    </div>
    <table class="table table-bordered" border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Religion</th>
                <th>City</th>
                <th>date</th>
                <th>Address</th>
                <th>KTP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->religion_id }}</td>
                    <td>{{ $item->city_id }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->ktp_picture }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No pending users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm">Back</a>
    </div>
</body>
</html>
