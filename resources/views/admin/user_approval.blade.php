<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">User Approval</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <a href="{{ route('users.approve', $user->id) }}" class="btn btn-success btn-sm">Approve</a>
                            <a href="{{ route('users.reject', $user->id) }}" class="btn btn-danger btn-sm">Reject</a>
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
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Pembayaran Pertama Approval</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Nominal</th>
                    <th>Tanggal Tf</th>
                    <th>Bukti Tf</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($iPays as $iPay)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $iPay->merchant_name }}</td>
                        <td>{{ $iPay->currency }}</td>
                        <td>{{ $iPay->date }}</td>
                        <td>{{ $iPay->photo }}</td>
                        <td>{{ $iPay->status }}</td>
                        <td>
                            <a href="{{ route('ipays.approve', $iPay->id) }}" class="btn btn-success btn-sm">Approve</a>
                            <!-- <a href="{{ route('ipays.reject', $iPay->id) }}" class="btn btn-danger btn-sm">Reject</a> -->
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
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Pembayaran Bulanan Approval</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Nominal</th>
                    <th>Tanggal Tf</th>
                    <th>Bukti Tf</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($monPays as $monPay)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $monPay->merchant_name }}</td>
                        <td>{{ $monPay->currency }}</td>
                        <td>{{ $monPay->date }}</td>
                        <td>{{ $monPay->photo }}</td>
                        <td>{{ $monPay->status }}</td>
                        <td>
                            <a href="{{ route('monpays.approve', $monPay->id) }}" class="btn btn-success btn-sm">Approve</a>
                            <!-- <a href="{{ route('monpays.reject', $iPay->id) }}" class="btn btn-danger btn-sm">Reject</a> -->
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
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Pembayaran Acara Approval</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Nominal</th>
                    <th>Tanggal Tf</th>
                    <th>Bukti Tf</th>
                    <th>Acara</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eventPays as $eventPay)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $eventPay->merchant_name }}</td>
                        <td>{{ $eventPay->currency }}</td>
                        <td>{{ $eventPay->date }}</td>
                        <td>{{ $eventPay->photo }}</td>
                        <td>{{ $eventPay->event->name }}</td>
                        <td>{{ $eventPay->status }}</td>
                        <td>
                            <a href="{{ route('eventpays.approve', $eventPay->id) }}" class="btn btn-success btn-sm">Approve</a>
                            <!-- <a href="{{ route('monpays.reject', $iPay->id) }}" class="btn btn-danger btn-sm">Reject</a> -->
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
    </div>
</body>
</html>
