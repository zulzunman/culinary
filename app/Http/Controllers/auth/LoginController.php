<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
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

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
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
        $role = Auth::user()->role;
        $userData = auth()->user(); // Mendapatkan pengguna yang sedang login
        // $username = Auth::user()->username;

        return view('index', ['role' => $role, 'userData' => $userData]);
    }

    public function error()
    {
        return view('error');
    }
}
