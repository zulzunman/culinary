<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" >
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" >
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" >
        <br>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" >
        <br>

    <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik') }}" >
        @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" >
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" id="gender" class="form-control" >
            <option value="" disabled selected>-- Select Gender --</option>
            <option value="Laki - laki" {{ old('gender') == 'Laki - laki' ? 'selected' : '' }}>Laki - laki</option>
            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" >
        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" >
        @error('date') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control" rows="3" >{{ old('address') }}</textarea>
        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="ktp_picture">KTP Picture</label>
        <textarea name="ktp_picture" id="ktp_picture" class="form-control" rows="3" >{{ old('ktp_picture') }}</textarea>
        <!-- <input type="file" name="ktp_picture" id="ktp_picture" class="form-control-file" > -->
        <!-- @error('ktp_picture') <small class="text-danger">{{ $message }}</small> @enderror -->
    </div>

    <div class="form-group">
        <label for="religion_id">Religion</label>
        <select name="religion_id" id="religion_id" class="form-control" >
            <option value="" disabled selected>-- Select Religion --</option>
            @foreach ($religions as $religion)
                <option value="{{ $religion->id }}" {{ old('religion_id') == $religion->id ? 'selected' : '' }}>
                    {{ $religion->name }}
                </option>
            @endforeach
        </select>
        @error('religion_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="city_id">City</label>
        <select name="city_id" id="city_id" class="form-control" >
            <option value="" disabled selected>-- Select City --</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
        @error('city_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

        <button type="submit">Register</button>
    </form>
    <a href="{{ route('login') }}">Already have an account? Login here</a>
</body>
</html>
