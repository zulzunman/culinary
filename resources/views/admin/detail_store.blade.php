<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Pedagang</h1>
    <li>NIK : {{ $merchant->nik}}</li>
    <li>Nama Lengkap : {{ $merchant->name}}</li>
    <li>Jenis Kelamin : {{ $merchant->gender}}</li>
    <li>Nomor HP : {{ $merchant->phone}}</li>
    <li>Agama : {{ $merchant->religion->name}}</li>
    <li>Tempat, Tanggal Lahir : {{ $merchant->city->name}}, {{ $merchant->date}}</li>
    <li>Alamat : {{ $merchant->address}}</li>
    <li>Foto KTP :
    <img src="{{ asset($merchant->ktp_picture) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
    </li>

    <h1>Data Toko</h1>
    <li>Nama Toko : {{ $product->store_name}}</li>
    <li>Nama Dagangan : {{ $product->name}}</li>
    <li>Jenis Dagangan : {{ $product->category}}</li>
    <li>Deskripsi Dagangan : {{ $product->desctiption}}</li>
    <li>Lokasi : {{ $product->location->code}}</li>
    <li>Foto Lapak :
    <img src="{{ asset($product->booth_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
    </li>
    <li>Foto Menu :
    <img src="{{ asset($product->menu_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
    </li>
    <li>Foto Produk :
    <img src="{{ asset($product->product_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
    </li>

    <div>
        <a href="{{ route('store-master.index') }}" class="btn btn-success btn-sm">Back</a>
    </div>
</body>
</html>
