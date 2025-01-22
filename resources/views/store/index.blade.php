<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="{{ route('store.update') }}" class="btn btn-success btn-sm">Edit Dagangan</a>
    </div>
    <table class="table table-bordered" border="2">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Dagangan</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Nama Toko</th>
                <th>Foto Lapak</th>
                <th>Foto Menu</th>
                <th>Foto Produk</th>
                <th>Kode Lokasi Lapak</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->desctiption }}</td>
                <td>{{ $data->store_name }}</td>
                <td>
                <img src="{{ asset($data->booth_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
                </td>
                <td>
                <img src="{{ asset($data->menu_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
                </td>
                <td>
                <img src="{{ asset($data->product_photo) }}"
                                                 class="preview-image"
                                                 id="booth_preview"
                                                 alt="Booth Preview" width="100">
                </td>
                <td>{{ $data->location_id }}</td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm">Back</a>
    </div>
</body>
</html>
