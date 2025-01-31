<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalAccountMail;
use App\Mail\ApprovalEventpayMail;
use App\Mail\ApprovalIpayMail;
use App\Mail\ApprovalMonpayMail;
use App\Models\Event;
use App\Models\EventDdues;
use App\Models\InitialPayment;
use App\Models\User;
use App\Models\MerchantProfile;
use App\Models\Monthly;
use App\Models\MounthlyDues;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApprovalController extends Controller
{
    // Tampilkan halaman daftar user
    public function index()
    {
        $users = User::where('status', 'PENDING')->get();
        // $iPays = InitialPayment::where('status', 'Diproses')->get();
        // Query untuk join dan mengambil nama pedagang dari merchants dan semua data dari payments
        $iPays = InitialPayment::select(
                    'initial_payments.*', // Mengambil semua kolom dari tabel payments
                    'merchant_profiles.name as merchant_name' // Mengambil nama pedagang dari merchants
                )
                ->join('merchant_profiles', 'initial_payments.user_id', '=', 'merchant_profiles.user_id') // Join dengan tabel merchants
                ->where('initial_payments.status', 'Diproses') // Kondisi untuk status 'Diproses'
                ->get();
        $monPays = MounthlyDues::select(
                    'monthly_dues.*', // Mengambil semua kolom dari tabel payments
                    'merchant_profiles.name as merchant_name' // Mengambil nama pedagang dari merchants
                )
                ->join('merchant_profiles', 'monthly_dues.user_id', '=', 'merchant_profiles.user_id') // Join dengan tabel merchants
                ->where('monthly_dues.status', 'Diproses') // Kondisi untuk status 'Diproses'
                ->get();
        $eventPays = EventDdues::select(
                    'event_dues.*', // Mengambil semua kolom dari tabel payments
                    'merchant_profiles.name as merchant_name' // Mengambil nama pedagang dari merchants
                )
                ->join('merchant_profiles', 'event_dues.user_id', '=', 'merchant_profiles.user_id') // Join dengan tabel merchants
                ->where('event_dues.status', 'Diproses') // Kondisi untuk status 'Diproses'
                ->get();

        return view('admin.user_approval', compact('users', 'iPays', 'monPays', 'eventPays'));
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

        $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();
        $product = Product::where('merchant_id', $merchantProfile->id)->get();

        // Kirim email verifikasi
        Mail::to($user->email)->send(new ApprovalAccountMail($user, $merchantProfile, $product));

        // Pemanggilan fungsi delete account
        $this->deleteAccount($user);

        return redirect()->back()->with('success', 'User has been rejected.');
    }

    // Approval Initial Payment
    public function approveIPay($id)
    {
        $iPay = InitialPayment::findOrFail($id);
        $iPay->status = 'Lunas';
        $iPay->save();

        $user = User::where('id', $iPay->user_id)->first();
        $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();

        // Kirim email verifikasi
        Mail::to($user->email)->send(new ApprovalIpayMail($user, $merchantProfile, $iPay));

        return redirect()->back()->with('success', 'User has been approved.');
    }

    // Approval Monthly Payment
    public function approveMonPay($id)
    {
        $monPay = MounthlyDues::findOrFail($id);
        $monPay->status = 'Lunas';
        $monPay->save();

        $user = User::where('id', $monPay->user_id)->first();
        $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();
        $month = Monthly::where('id', $monPay->month_id)->first();

        // // Kirim email verifikasi
        Mail::to($user->email)->send(new ApprovalMonpayMail($user, $merchantProfile, $month));

        return redirect()->back()->with('success', 'User has been approved.');
    }
    // public function rejectIPay($id)

    // Approval Event Payment
    public function approveEventPay($id)
    {
        $eventPay = EventDdues::findOrFail($id);
        $eventPay->status = 'Lunas';
        $eventPay->save();

        $user = User::where('id', $eventPay->user_id)->first();
        $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();
        $event = Event::where('id', $eventPay->event_id)->first();

        // // Kirim email verifikasi
        Mail::to($user->email)->send(new ApprovalEventpayMail($user, $merchantProfile, $event));

        return redirect()->back()->with('success', 'User has been approved.');
    }
    // public function rejectIPay($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->status = 'REJECT';
    //     $user->save();

    //     $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();
    //     $product = Product::where('merchant_id', $merchantProfile->id)->get();

    //     // Kirim email verifikasi
    //     Mail::to($user->email)->send(new ApprovalAccountMail($user, $merchantProfile, $product));

    //     // Pemanggilan fungsi delete account
    //     $this->deleteAccount($user);

    //     return redirect()->back()->with('success', 'User has been rejected.');
    // }
    public function deleteAccount($user)
    {
        $user->delete();
    }
}
