<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalAccountMail;
use App\Models\User;
use App\Models\MerchantProfile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApprovalController extends Controller
{
    // Tampilkan halaman daftar user
    public function index()
    {
        $users = User::where('status', 'PENDING')->get();
        return view('admin.user_approval', compact('users'));
    }

    // Approve user
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'APPROVE';
        $user->save();

        $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();
        $product = Product::where('merchant_id', $merchantProfile->id)->get();

        // Kirim email verifikasi
        Mail::to($user->email)->send(new ApprovalAccountMail($user, $merchantProfile, $product));

        return redirect()->back()->with('success', 'User has been approved.');
    }

    // Reject user
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'REJECT';
        $user->save();

        $merchantProfile = MerchantProfile::where('user_id', $user->id)->get();
        $product = Product::where('merchant_id', $merchantProfile->id)->get();

        // Kirim email verifikasi
        Mail::to($user->email)->send(new ApprovalAccountMail($user, $merchantProfile, $product));

        return redirect()->back()->with('success', 'User has been rejected.');
    }
}
