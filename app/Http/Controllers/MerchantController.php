<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\MerchantProfile;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    public function index()
    {
        $data = MerchantProfile::all();

        // Mengirim data ke view
        return view('merchant.index', compact('data'));
    }

    public function update()
    {
        $religions = Religion::all();
        $cities = City::all();
        $user = Auth::user()->id;
        $merchantProfile = MerchantProfile::where('user_id', $user)->first();

        // Mengirim data ke view
        return view('merchant.edit', compact('religions', 'cities', 'user', 'merchantProfile'));
    }

    public function edit(Request $request)
    {
        // Find user by ID
        $user = Auth::user();
        $merchantProfile = MerchantProfile::where('user_id', $user->id)->first();
        if (!$merchantProfile) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found',
            ], 404);
        }

        $request->validate([
            'nik' => 'sometimes',
            'name' => 'sometimes|string|max:255',
            'gender' => 'sometimes|in:Laki - laki,Perempuan',
            'phone' => 'sometimes|string|max:15|regex:/^[0-9]+$/',
            'date' => 'sometimes|date',
            'address' => 'sometimes|string|max:500',
            'ktp_picture' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'religion_id' => 'sometimes|exists:religions,id',
            'city_id' => 'sometimes|exists:citys,id',

        ]);

        DB::beginTransaction();

        try {
            // Update name
            if ($request->has('nik')) {
                $merchantProfile->nik = $request->nik;
            }
            if ($request->has('name')) {
                $merchantProfile->name = $request->name;
            }
            if ($request->has('gender')) {
                $merchantProfile->gender = $request->gender;
            }
            if ($request->has('phone')) {
                $merchantProfile->phone = $request->phone;
            }
            if ($request->has('date')) {
                $merchantProfile->date = $request->date;
            }
            if ($request->has('religion_id')) {
                $merchantProfile->religion_id = $request->religion_id;
            }
            if ($request->has('city_id')) {
                $merchantProfile->city_id = $request->city_id;
            }
            if ($request->has('address')) {
                $merchantProfile->address = $request->address;
            }

            // Process KTP picture upload
            if ($request->hasFile('ktp_picture')) {
                $ktpPicture = $request->file('ktp_picture');
                $nik = $request->nik;
                $name = $request->name;

                // Delete old KTP picture if exists
                if ($user->ktp_picture && file_exists(public_path($user->ktp_picture))) {
                    unlink(public_path($user->ktp_picture));
                }

                // Create new filename
                $filename = $nik . '-' . str_replace(' ', '_', $name) . '-' . $user->id . '.' . $ktpPicture->getClientOriginalExtension();

                // Define storage path
                $destinationPath = 'assets/img/ktp_picture/' . $filename;
                $ktpPicture->move(public_path('assets/img/ktp_picture'), $filename);

                // Update KTP picture column
                $merchantProfile->ktp_picture = $destinationPath ? str_replace('public/', '', $destinationPath) : null;
            }
            $merchantProfile->save();

            DB::commit(); // Jika semua proses berhasil
            return redirect()->route('dashboard')->with('success', 'Berhasil melengkapi data');
        } catch (\Exception $e) {
            DB::rollBack(); // Membatalkan semua perubahan jika terjadi error
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }
}
