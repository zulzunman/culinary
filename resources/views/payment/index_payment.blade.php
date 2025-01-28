<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pembayaran Pertama</h1>
    <table border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>nominal</th>
                <th>tanggal tf</th>
                <th>bukti tf</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $iPay->currency }}</td>
                <td>{{ $iPay->date }}</td>
                <td>{{ $iPay->photo }}</td>
                <td>{{ $iPay->status }}</td>
            </tr>
        </tbody>
    </table>
    <h1>Pembayaran Bulanan</h1>
    <div>
        <a href="{{ route('monpay.create') }}" class="btn btn-success btn-sm">Tambah Pembayaran Bulanan</a>
    </div>
    <table border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>nominal</th>
                <th>tanggal tf</th>
                <th>bukti tf</th>
                <th>bulan</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($monPays as $monPay)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $monPay->currency }}</td>
                        <td>{{ $monPay->date }}</td>
                        <td>{{ $monPay->photo }}</td>
                        <td>{{ $monPay->month->name }}</td>
                        <td>{{ $monPay->status }}</td>
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
    <h1>Pembayaran Acara</h1>
    <div>
        <a href="{{ route('eventpay.create') }}" class="btn btn-success btn-sm">Tambah Pembayaran Acara</a>
    </div>
    <table border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>nominal</th>
                <th>tanggal tf</th>
                <th>bukti tf</th>
                <th>nama acara</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($eventPays as $eventPay)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $eventPay->currency }}</td>
                        <td>{{ $eventPay->date }}</td>
                        <td>{{ $eventPay->photo }}</td>
                        <td>{{ $eventPay->event->name }}</td>
                        <td>{{ $eventPay->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No pending users found.</td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</body>
</html>
