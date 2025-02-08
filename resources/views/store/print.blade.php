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
            /* border: 1px solid black; */
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
                        <td class="text-center" style="padding:10px;" colspan="2">
                            <p>gambar</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="padding:10px;" colspan="2">
                            <p><b>Pemerintah Kota</b></p>
                            <p><b>Bandung</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center" >
                            <p><b>PEDAGANG KAKI LIMA (PKL)</b></p>
                            <p><b>BINAAN SATGAS PKL</b></p>
                            <p><b>KOTA BANDUNG</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px;">
                            <p>Nama Toko : {{ $product->store_name }}</p>
                            <p>Nama Pelanggan : {{ $merchant->name }}</p>
                            <p>Jenis Dagangan : {{ $product->category }}</p>
                            <p>Deskripsi Dagangan : {{ $product->desctiption }}</p>
                        </td>
                        <td class="text-center" style="padding:50px; border: 1px solid #333;">
                            {{ $product->location->code }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
