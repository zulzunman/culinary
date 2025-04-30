<!DOCTYPE html>
<html>
<head>
    <title>{{ $judul }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .card-container {
            width: 100%;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
        }
        .card {
            width: 100%;
            border: 2px solid #1e5799;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            background-color: #1e5799;
            color: white;
            padding: 15px 10px;
            text-align: center;
        }
        .header-title {
            font-size: 22px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .header-subtitle {
            font-size: 18px;
            margin: 5px 0;
            font-weight: normal;
        }
        .content {
            display: table;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .content-left {
            display: table-cell;
            width: 75%;
            vertical-align: top;
            padding: 10px;
            box-sizing: border-box;
        }
        .content-right {
            display: table-cell;
            width: 25%;
            vertical-align: middle;
            text-align: center;
            padding: 10px 20px 10px 0;
            box-sizing: border-box;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px 5px;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-weight: bold;
            width: 30%;
        }
        .qr-container {
            border: 2px dashed #1e5799;
            padding: 10px;
            text-align: center;
            margin: 0 auto;
            width: 90%;
            box-sizing: border-box;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
            padding: 10px;
        }
        .logo-area {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .logo-cell {
            display: table-cell;
            width: 20%;
            vertical-align: middle;
            text-align: center;
        }
        .title-cell {
            display: table-cell;
            width: 60%;
            vertical-align: middle;
            text-align: center;
        }
        .logo {
            /* border: 1px solid #ccc; */
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            /* background-color: #f5f5f5; */
        }
        .badge {
            background-color: #ff6b6b;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card">
            <div class="header">
                <div class="logo-area">
                    <div class="logo-cell">
                        <div class="logo">
                            <img src="{{ public_path('assets/pemkot.png') }}" alt="Logo Pemkot Bandung" style="max-width: 100px; max-height: 100px;">
                        </div>
                    </div>
                    <div class="title-cell">
                        <div class="header-title">Pemerintah Kota Bandung</div>
                        <div class="header-subtitle">Pedagang Kaki Lima (PKL)</div>
                        <div class="header-subtitle">Binaan Satgas PKL Kota Bandung</div>
                        <div class="badge">TERDAFTAR RESMI</div>
                    </div>
                    <div class="logo-cell">
                        <div class="logo">
                            <img src="{{ public_path('assets/logo1.png') }}" alt="Logo Satgas PKL" style="max-width: 100px; max-height: 100px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="content-left">
                    <table class="info-table">
                        <tr>
                            <td class="info-label">Nama Toko</td>
                            <td>: {{ $product->store_name }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Nama Pedagang</td>
                            <td>: {{ $merchant->name }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Jenis Dagangan</td>
                            <td>: {{ $product->category }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Deskripsi Dagangan</td>
                            <td>: {{ $product->desctiption }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Tanggal Terdaftar</td>
                            <td>: {{ date('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="info-label">Masa Berlaku</td>
                            <td>: {{ date('d F Y', strtotime('+1 year')) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="content-right">
                    <div class="qr-container">
                        <div style="margin-bottom: 10px;"><strong>KODE LAPAK</strong></div>
                        <div style="font-size: 24px; font-weight: bold; color: #1e5799; padding: 15px 0;">
                            {{ $product->location->code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                Diterbitkan oleh Satgas PKL Kota Bandung &copy; {{ date('Y') }}
            </div>
        </div>
    </div>
</body>
</html>