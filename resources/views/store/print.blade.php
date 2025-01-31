<!DOCTYPE html>
<html>
<head>
    <title>{{ $judul }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .text-center {
            text-align: center;
        }

        p{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr >
            <td>
                <table style="border-collapse: collapse; height: 90px;"  >
                    <tr>
                        <td class="text-center" style="padding:10px; border: 1px solid #333;">
                            <p>gambar</p>
                        </td>
                        <td colspan="2" class="text-center" style="border: 1px solid #333;">
                            <p><b>Pemerintah Kota Bandung</b></p>
                            <p><b>Pedagang Kaki Lima (PKL)</b></p>
                            <p><b>Binaan Satgas PKL</b></p>
                            <p><b>Kota Bandung</b></p>
                        </td>
                        <td class="text-center" style="padding:10px; border: 1px solid #333;">
                            {{ $product->location->code }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px; border: 1px solid #333;" colspan="2">
                            <p>Nama Toko : {{ $product->nama_toko }}</p>
                        </td>
                        <td style="padding-left:5px; border: 1px solid #333;" colspan="2">
                            <p>Nama Pelanggan : {{ $merchant->nama_pedagang }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
