<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\MerchantProfile;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Register View
    public function showRegister()
    {
        // Mengambil semua data dari tabel religion
        $religions = Religion::all();
        $cities = City::all();

        // Mengirim data ke view
        return view('auth.register', compact('religions', 'cities'));
    }

    // Register Logic
    public function register(Request $request)
    {
        // dd($request);
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'nik' => 'required|unique:merchant_profiles,nik',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'date' => 'required|date',
            'address' => 'required|string|max:500',
            // 'ktp_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ktp_picture' => 'required',
            'religion_id' => 'required|exists:religions,id',
            'city_id' => 'required|exists:citys,id',
        ]);

        // Membuat user baru
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $merchant = MerchantProfile::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'date' => $request->date,
            'address' => $request->address,
            'ktp_picture' => $request->ktp_picture,
            'religion_id' => $request->religion_id,
            'city_id' => $request->city_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
