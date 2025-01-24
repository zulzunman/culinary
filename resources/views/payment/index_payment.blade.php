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
</body>
</html>
