<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile Merchant</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
            <h1 class="text-2xl font-bold mb-6">Update Profile Merchant</h1>

            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('merchant.edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6">
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                        <input type="text" id="nik" name="nik"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $merchantProfile->nik }}">
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ $merchantProfile->name }}">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            <div class="flex items-center">
                                <input type="radio" name="gender" value="Laki - laki"
                                    class="w-4 h-4 text-blue-600"
                                    {{ ( $merchantProfile->gender == 'Laki - laki') ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900">Laki-laki</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="gender" value="Perempuan"
                                    class="w-4 h-4 text-blue-600"
                                    {{ ( $merchantProfile->gender == 'Perempuan') ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('phone', $merchantProfile->phone ?? '') }}">
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                        <input type="date" id="date" name="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('date', $merchantProfile->date ?? '') }}">
                    </div>

                    <!-- Religion -->
                    <div>
                        <label for="religion_id" class="block mb-2 text-sm font-medium text-gray-900">Agama</label>
                        <select id="religion_id" name="religion_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Agama</option>
                            @foreach($religions as $religion)
                                <option value="{{ $religion->id }}"
                                    {{ (old('religion_id', $merchantProfile->religion_id ?? '') == $religion->id) ? 'selected' : '' }}>
                                    {{ $religion->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city_id" class="block mb-2 text-sm font-medium text-gray-900">Kota</label>
                        <select id="city_id" name="city_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Kota</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ (old('city_id', $merchantProfile->city_id ?? '') == $city->id) ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('address', $merchantProfile->address ?? '') }}</textarea>
                    </div>

                    <!-- KTP Picture -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Foto KTP</label>
                        @if($merchantProfile->ktp_picture)
                            <div class="mb-3">
                                <img src="{{ asset($merchantProfile->ktp_picture) }}" alt="KTP" class="max-w-xs rounded">
                            </div>
                        @endif
                        <input type="file" id="ktp_picture" name="ktp_picture" accept="image/jpeg,image/png,image/jpg"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG atau JPEG (MAX. 2MB)</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <a href="{{ route('merchant.index') }}" class="button">
                        Kembali
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
