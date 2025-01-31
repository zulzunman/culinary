<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDdues;
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
        $monPays = MounthlyDues::with('month')->where('user_id', $user->id)->get();
        $eventPays = EventDdues::with('event')->where('user_id', $user->id)->get();
        $merchant = $user->merchant;
        $months = Monthly::all();
        $events = Event::all();
        // Pastikan merchant ada sebelum mengakses relasi
        if ($merchant) {
            $hasKtp = !is_null($merchant->ktp_picture);
            $hasBoothPhoto = !is_null(optional($merchant->product)->booth_photo);

            $condition = $hasKtp && $hasBoothPhoto;
        } else {
            $condition = false;
        }

        return view('payment.index_payment', compact('iPay', 'monPays', 'eventPays', 'months', 'events', 'condition'));
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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment created successfully'
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create payment: ' . $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Failed to create payment: ' . $e->getMessage());
        }
    }
    public function createEventPay()
    {
        $events = Event::all();
        return view('payment.eventpay.create_eventpay', compact('events'));
    }
    public function addEventPay(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $request->validate([
                'currency' => 'required',
                'date' => 'required|date',
                'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                'event_id' => 'required|exists:events,id', // Perbaiki validasi
            ]);

            $eventPay_Picture = $request->file('photo');
            $filename = 'img' . '-' . str_replace(' ', '_', 'eventPayment') . '-' . $request->input('event_id') . '-' . $user->id . '.' . $eventPay_Picture->getClientOriginalExtension();
            $destinationPath = 'assets/img/eventPay/' . $filename;
            $eventPay_Picture->move(public_path('assets/img/eventPay'), $filename);

            $eventPay = new EventDdues();
            $eventPay->currency = $request->input('currency');
            $eventPay->date = $request->input('date');
            $eventPay->photo = $destinationPath;
            $eventPay->event_id = $request->input('event_id');
            $eventPay->user_id = $user->id;
            $eventPay->save();

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment created successfully'
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create payment: ' . $e->getMessage()
                ], 422);
            }

            return back()->with('error', 'Failed to create payment: ' . $e->getMessage());
        }
    }
}
