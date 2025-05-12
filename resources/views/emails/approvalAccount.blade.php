<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Akun Pedagang</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 650px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 180px;
            margin-bottom: 15px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .merchant-info {
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: none;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: none;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f2f7ff;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        td {
            border-bottom: 1px solid #eaeaea;
        }

        .status-approved {
            color: #27ae60;
            font-weight: bold;
            background-color: #e7f9ef;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .status-rejected {
            color: #e74c3c;
            font-weight: bold;
            background-color: #fde9e7;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .cta-button {
            display: block;
            text-align: center;
            margin: 30px auto;
        }

        .cta-button a {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .cta-button a:hover {
            background-color: #2980b9;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
            color: #7f8c8d;
            font-size: 14px;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-links a {
            margin: 0 10px;
            text-decoration: none;
            color: #3498db;
        }

        @media screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            .email-container {
                padding: 15px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <!-- Tambahkan logo perusahaan Anda di sini -->
            <img src="/api/placeholder/180/60" alt="Logo Perusahaan" class="logo">
            <h1>Pengajuan Akun Pedagang</h1>
        </div>

        <div class="merchant-info">
            <p>Halo, <strong>{{ $merchantProfile['name'] }}</strong></p>
            <p>Kami telah meninjau pengajuan akun dagang Anda dengan detail sebagai berikut:</p>
        </div>

        <table>
            <tr>
                <th>Nama Pedagang</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
                @if ($user['status'] == 'REJECT')
                    <th>Pesan</th>
                @endif
            </tr>
            <tr>
                <td>{{ $merchantProfile['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $merchantProfile['nik'] }}</td>
                    @if ($user['status'] == 'APPROVE')
                        <td>
                            <span class="status-approved">DITERIMA</span>
                        </td>
                    @else
                        <td>
                            <span class="status-rejected">DITOLAK</span>
                        </td>
                        <td>{{ $comment }}</td>
                    @endif
            </tr>
        </table>

        @if ($user['status'] == 'APPROVE')
            <div class="cta-button">
                <a href="{{ config('app.url') }}">LOGIN KE APLIKASI</a>
            </div>
            <p>Selamat bergabung dengan platform kami! Anda dapat mengakses akun pedagang dengan menggunakan email dan password di atas.</p>
        @else
            <p>Mohon maaf, pengajuan akun Anda belum dapat disetujui. Silakan hubungi tim kami untuk informasi lebih lanjut.</p>
        @endif

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda.</p>
            <p>Jika ada pertanyaan, silakan hubungi customer service kami.</p>
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">Instagram</a> |
                <a href="#">WhatsApp</a>
            </div>
            <p>&copy; 2025 Nama Perusahaan Anda. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</body>
</html>