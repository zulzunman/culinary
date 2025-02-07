<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InitialPayment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->status !== 'APPROVE') {
            return back()->withErrors(['email' => 'Akun Anda belum disetujui oleh admin.'])->withInput();
        }

        $merchant = $user->merchant;

        if ($merchant) {
            $hasKtp = !is_null($merchant->ktp_picture);
            $hasBoothPhoto = !is_null(optional($merchant->product)->booth_photo);
            $condition = $hasKtp && $hasBoothPhoto;
        } else {
            $condition = false;
        }

        // Jika user adalah admin, tambahkan data untuk tabel approval
        if ($user->username == 'Super Admin' || $user->username == 'Admin') {
            $users = User::where('status', 'PENDING')->get();
            return view('dashboard', compact('users'));
        } else {
            $iPay = InitialPayment::where('user_id', $user->id)->first();
            if (!$iPay || $iPay->status !== 'Lunas') {
                return redirect()->route('ipay.create');
            }
            return view('dashboard', compact('condition'));
        }
    }
}
