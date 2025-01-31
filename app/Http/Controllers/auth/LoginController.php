<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\InitialPayment;
use App\Models\MerchantProfile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Login View
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login Logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Jika user tidak ditemukan atau password salah
        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
        $user = Auth::user();

        // Cek apakah status user bukan 'approved'
        if ($user->status !== 'APPROVE') {
            return back()->withErrors(['email' => 'Akun Anda belum disetujui oleh admin.'])->withInput();
        }

        $iPay = InitialPayment::where('user_id', $user->id)->first();

        if ($user->username == 'Super Admin' || $user->username == 'Admin') {
            return redirect()->route('dashboard');
        } else {
            if (!$iPay || $iPay->status !== 'Lunas') {
                return redirect()->route('ipay.create');
            }
            return redirect()->route('dashboard');
        }
    }

    // Logout Logic
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    // Dashboard berdasarkan role
    public function dashboard()
    {
        $user = Auth::user();

        // Cek apakah status user bukan 'approved'
        if ($user->status !== 'APPROVE') {
            return back()->withErrors(['email' => 'Akun Anda belum disetujui oleh admin.'])->withInput();
        }

        $merchant = $user->merchant;
        $condition = $merchant?->ktp_picture && $merchant->product?->booth_photo;

        $iPay = InitialPayment::where('user_id', $user->id)->first();

        if ($user->username == 'Super Admin' || $user->username == 'Admin') {
            return view('dashboard');
        } else {
            if (!$iPay || $iPay->status !== 'Lunas') {
                return redirect()->route('ipay.create');
            }
            return view('dashboard', compact('condition'));
        }
    }

    public function error()
    {
        return view('error');
    }
}
