<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\City;
use App\Models\Location;
use App\Models\MerchantProfile;
use App\Models\Product;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    // Register View
    public function showRegister()
    {
        $locations = Location::all();
        // Mengirim data ke view
        return view('auth.register', compact( 'locations'));
    }

    // Register Logic
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'nik' => 'required|min:16|unique:merchant_profiles,nik',
            'name' => 'required|string|max:255',
            'name_product' => 'required|string|max:255',
            'phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        DB::beginTransaction();

        try {
            // Membuat user baru
            $user = new User();
            $user->username = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('nik');
            $user->save();

            // Membuat merchant profile
            $merchantProfile = new MerchantProfile();
            $merchantProfile->nik = $request->input('nik');
            $merchantProfile->name = $request->input('name');
            $merchantProfile->phone = $request->input('phone');
            $merchantProfile->user_id = $user->id;
            $merchantProfile->save();

            // Membuat data toko
            $product = new Product();
            $product->name = $request->input('name_product');
            $product->category = $request->input('category');
            $product->description = $request->input('description');
            $product->location_id = $request->input('location_id');
            $product->merchant_id = $merchantProfile->id;
            $product->save();

            // Kirim email verifikasi
            Mail::to($user->email)->send(new RegisterMail($user, $merchantProfile, $product));


            DB::commit(); // Jika semua proses berhasil
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            DB::rollBack(); // Membatalkan semua perubahan jika terjadi error
            return back()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}
