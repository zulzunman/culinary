<?php

namespace App\Http\Controllers;

use App\Models\InitialPayment;
use App\Models\Monthly;
use App\Models\MounthlyDues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $iPay = InitialPayment::where('user_id', $user->id)->first();

        // Mengirim data ke view
        return view('payment.index_payment', compact('iPay'));
    }
    public function createIPay()
    {
        return view('payment.ipay.create_ipay');
    }
    public function addIPay(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $request->validate([
                'currency' => 'required',
                'date' => 'required|date',
                'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $iPay_Picture = $request->file('photo');
            $filename = 'img' . '-' . str_replace(' ', '_', 'iPayment') . '-' . $user->id . '.' . $iPay_Picture->getClientOriginalExtension();
            $destinationPath = 'assets/img/iPay/' . $filename;
            $iPay_Picture->move(public_path('assets/img/iPay'), $filename);

            $iPay = new InitialPayment();
            $iPay->currency = $request->input('currency');
            $iPay->date = $request->input('date');
            $iPay->photo = $destinationPath;
            $iPay->user_id = $user->id;
            $iPay->save();

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create payment: ' . $e->getMessage());
        }
    }

    public function createMonPay()
    {
        $months = Monthly::all();
        return view('payment.monpay.create_monpay', compact('months'));
    }
    public function addMonPay(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $request->validate([
                'currency' => 'required',
                'date' => 'required|date',
                'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                'month_id' => 'required|exists:month,id',
            ]);

            $monPay_Picture = $request->file('photo');
            $filename = 'img' . '-' . str_replace(' ', '_', 'monPayment') . '-' . $user->id . '.' . $monPay_Picture->getClientOriginalExtension();
            $destinationPath = 'assets/img/monPay/' . $filename;
            $monPay_Picture->move(public_path('assets/img/monPay'), $filename);

            $monPay = new MounthlyDues();
            $monPay->currency = $request->input('currency');
            $monPay->date = $request->input('date');
            $monPay->photo = $destinationPath;
            $monPay->month_id = $request->input('month_id');
            $monPay->user_id = $user->id;
            $monPay->save();

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create payment: ' . $e->getMessage());
        }
    }
}
