<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\InitialPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

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

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $user = Auth::user();

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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function error()
    {
        return view('error');
    }
}
