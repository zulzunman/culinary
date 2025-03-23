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

        .content {
            margin-bottom: 25px;
        }

        .review-status {
            background-color: #f5f7fa;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .status-icon {
            text-align: center;
            margin: 20px 0;
        }

        .status-circle {
            width: 80px;
            height: 80px;
            background-color: #f39c12;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .status-circle svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .timeline {
            display: flex;
            margin: 30px 0;
            position: relative;
            justify-content: space-between;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 15%;
            width: 70%;
            height: 3px;
            background-color: #e0e0e0;
            z-index: 1;
        }

        .timeline-step {
            text-align: center;
            z-index: 2;
            flex: 1;
            position: relative;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .step-icon.active {
            background-color: #3498db;
            color: white;
        }

        .step-text {
            font-size: 12px;
            color: #7f8c8d;
        }

        .step-text.active {
            color: #3498db;
            font-weight: bold;
        }

        .next-steps {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
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

            .timeline::before {
                left: 10%;
                width: 80%;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <!-- Tambahkan logo Culinary Lengkong di sini -->
            <img src="/api/placeholder/180/60" alt="Culinary Lengkong" class="logo">
            <h1>Pengajuan Akun Pedagang</h1>
        </div>

        <div class="content">
            <p>Halo, <strong>{{ $merchantProfile['name'] }}</strong></p>

            <div class="status-icon">
                <div class="status-circle">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 6v6l4 2M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                    </svg>
                </div>
            </div>

            <div class="review-status">
                <p><strong>Status Pengajuan:</strong> Sedang Ditinjau</p>
                <p>Akun Anda sedang dalam proses peninjauan oleh tim pengurus Culinary Lengkong.</p>
            </div>

            <div class="timeline">
                <div class="timeline-step">
                    <div class="step-icon active">✓</div>
                    <div class="step-text active">Pendaftaran</div>
                </div>
                <div class="timeline-step">
                    <div class="step-icon active">⌛</div>
                    <div class="step-text active">Peninjauan</div>
                </div>
                <div class="timeline-step">
                    <div class="step-icon">✓</div>
                    <div class="step-text">Persetujuan</div>
                </div>
                <div class="timeline-step">
                    <div class="step-icon">🚀</div>
                    <div class="step-text">Aktif</div>
                </div>
            </div>

            <div class="next-steps">
                <p><strong>Langkah Selanjutnya:</strong></p>
                <p>Mohon tunggu konfirmasi melalui email dalam beberapa hari ke depan untuk dapat mulai menggunakan akun Anda. Tim kami sedang melakukan verifikasi data yang Anda berikan.</p>
            </div>

            <p>Terima kasih atas kesabaran Anda. Kami akan segera menghubungi Anda setelah proses peninjauan selesai.</p>
        </div>

        <div class="footer">
            <p>Salam hangat dari tim Culinary Lengkong</p>
            <p>Jika ada pertanyaan, silakan hubungi kami melalui kontak di bawah ini:</p>
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">Instagram</a> |
                <a href="#">WhatsApp</a>
            </div>
            <p>&copy; 2025 Culinary Lengkong. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</body>
</html>