<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Iuran Bulanan</title>
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

        .content {
            margin-bottom: 25px;
        }

        .success-icon {
            text-align: center;
            margin: 20px 0;
        }

        .success-circle {
            width: 80px;
            height: 80px;
            background-color: #27ae60;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .success-circle svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .notification-box {
            background-color: #e7f9ef;
            border-left: 4px solid #27ae60;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .month-highlight {
            font-weight: bold;
            color: #3498db;
            font-size: 18px;
            display: inline-block;
            background-color: #eaf6fd;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .receipt-container {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
            border: 1px dashed #ddd;
        }

        .receipt-header {
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .paid-stamp {
            position: relative;
            text-align: right;
            margin-top: 10px;
        }

        .paid-text {
            display: inline-block;
            color: #27ae60;
            font-weight: bold;
            font-size: 18px;
            border: 2px solid #27ae60;
            padding: 5px 15px;
            border-radius: 4px;
            transform: rotate(-5deg);
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
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <!-- Tambahkan logo perusahaan/organisasi Anda di sini -->
            <img src="/api/placeholder/180/60" alt="Logo Organisasi" class="logo">
            <h1>Konfirmasi Pembayaran Iuran Bulanan</h1>
        </div>

        <div class="content">
            <p>Halo, <strong>{{ $merchantProfile['name'] }}</strong></p>

            <div class="success-icon">
                <div class="success-circle">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                </div>
            </div>

            <div class="notification-box">
                <p>Pembayaran iuran bulanan untuk bulan <span class="month-highlight">{{ $month['name'] }}</span> Anda telah <strong>DIKONFIRMASI</strong> oleh pengurus.</p>
            </div>

            <div class="receipt-container">
                <div class="receipt-header">Detail Pembayaran</div>
                <div class="receipt-row">
                    <span>Bulan:</span>
                    <span>{{ $month['name'] }}</span>
                </div>
                <div class="receipt-row">
                    <span>Status:</span>
                    <span>Lunas</span>
                </div>
                <div class="receipt-row">
                    <span>Tanggal Konfirmasi:</span>
                    <span>{{ date('d M Y') }}</span>
                </div>
                <div class="paid-stamp">
                    <span class="paid-text">LUNAS</span>
                </div>
            </div>

            <p>Anda dapat melihat riwayat pembayaran iuran bulanan dan informasi lainnya melalui menu pembayaran bulanan di aplikasi.</p>
        </div>

        <div class="footer">
            <p>Terima kasih atas kontribusi Anda.</p>
            <p>Jika ada pertanyaan, silakan hubungi pengurus.</p>
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">Instagram</a> |
                <a href="#">WhatsApp</a>
            </div>
            <p>&copy; 2025 Nama Organisasi Anda. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</body>
</html>