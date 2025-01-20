<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Akun Pedagang</title>
</head>
<body>
    <h1>Halo, {{ $merchantProfile['name'] }}</h1>
    <p>Pengajuan Dagang dengan detail sebagai berikut : </p>
    <table border="2">
        <tr>
            <th>Nama Pedagang</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <tr>
            <td>{{ $merchantProfile['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $merchantProfile['nik'] }}</td>
        </tr>
    </table>
    <p>Silakan Untuk Login ke Aplikasi</p>
    <p>Terima Kasih</p>
</body>
</html>
