<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        $user = Auth::user();
        $merchant = $user->merchant;
        // Pastikan merchant ada sebelum mengakses relasi
        if ($merchant) {
            $hasKtp = !is_null($merchant->ktp_picture);
            $hasBoothPhoto = !is_null(optional($merchant->product)->booth_photo);

            $condition = $hasKtp && $hasBoothPhoto;
        } else {
            $condition = false;
        }
        return view('auth.change-password', compact('condition'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()
            ->back()
            ->with('success', 'Password berhasil diubah!');
    }
}
