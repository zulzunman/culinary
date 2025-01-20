<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Location;
use App\Models\MerchantProfile;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resendVerification');
    }

    // Register View
    public function showRegister()
    {
        // Mengambil semua data dari tabel religion
        $religions = Religion::all();
        $cities = City::all();
        $location = Location::all();

        // Mengirim data ke view
        return view('auth.register', compact('religions', 'cities'));
    }

    // Register Logic
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'nik' => 'required|min:16|unique:merchant_profiles,nik',
            // 'nik' => 'required|unique:merchant_profiles,nik',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'date' => 'required|date',
            'address' => 'required|string|max:500',
            'ktp_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'ktp_picture' => 'required',
            'religion_id' => 'required|exists:religions,id',
            'city_id' => 'required|exists:citys,id',
        ]);

        DB::beginTransaction();

        try {
            // Upload file ke public/assets/img/ktp_picture dengan format nik-name-user_id
            $ktpPicture = $request->file('ktp_picture');
            $nik = $request->nik;
            $name = $request->name;
            $userId = 0; // Variabel user_id diinisialisasi

            // Membuat user baru
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $userId = $user->id; // Mengambil user_id setelah user berhasil dibuat

            // Menyimpan file dengan format nik-name-user_id
            $ktpPictureName = $nik . '-' . str_replace(' ', '_', $name) . '-' . $userId . '.' . $ktpPicture->getClientOriginalExtension();
            $ktpPicturePath = 'assets/img/ktp_picture/' . $ktpPictureName;
            $ktpPicture->move(public_path('assets/img/ktp_picture'), $ktpPictureName);

            // Membuat merchant profile
            MerchantProfile::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'date' => $request->date,
                'address' => $request->address,
                'ktp_picture' => $ktpPicturePath,
                'religion_id' => $request->religion_id,
                'city_id' => $request->city_id,
                'user_id' => $user->id,
            ]);

            // Kirim email verifikasi
            $user->sendEmailVerificationNotification();


            DB::commit(); // Jika semua proses berhasil
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            DB::rollBack(); // Membatalkan semua perubahan jika terjadi error
            return back()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }

    // Email Verification Notice
    public function notice()
    {
        return view('auth.verify-email');
    }

    // Handle Email Verification
    public function verify(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if URL is valid
        if (!$request->hasValidSignature()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid verification link or link has expired'
            ], 400);
        }

        // Check if user is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'Email already verified. You can now login.');
        }

        // Verify the email
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('login')->with('success', 'Email has been verified successfully. You can now login.');
    }

    // Resend Verification Email
    public function resendVerification(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        if ($user->hasVerifiedEmail()) {
            return back()->with('success', 'Email already verified. You can login.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link has been sent to your email address.');
    }
}
