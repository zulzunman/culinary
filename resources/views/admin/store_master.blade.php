<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Toko</th>
                <th>Lokasi</th>
                <th>Nama Penjual</th>
                <th>No HP</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->store_name }}</td>
                    <td>{{ $item->location_id }}</td>
                    <td>{{ $item->merchant_name }}</td>
                    <td>{{ $item->merchant_phone }}</td>
                    <td>
                        <a href="{{ route('store-master.detail', $item->id) }}" class="btn btn-success btn-sm">Detail</a>
                    </td>
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
