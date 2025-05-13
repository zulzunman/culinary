<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class MapController extends Controller
{
    // public function getLocations()
    // {
    //     // $locations = Location::all(); // Ambil semua data lokasi
    //     $locations = Location::all()->map(function ($loc) {
    //     // $locations = Location::with('product')->map(function ($loc) {
    //         return [
    //             'id' => $loc->id,
    //             'code' => $loc->code,
    //             'detail' => $loc->detail,
    //             'latitude' => $loc->latitude,
    //             'longitude' => $loc->longitude,
    //             'is_used' => $loc->isUsed(), // Tambahkan status apakah sudah dipakai
    //             // 'store_name' => $loc->product ? $loc->product->store_name : null,
    //         ];
    //     });
    //     return response()->json($locations);
    // }
    public function getLocations()
    {
        $locations = Location::with('product')->get()->map(function ($loc) {
            $imageUrl = null;
            $boothPhotoUrl = null;
            $description = null;

            if ($loc->product) {
                // Menambahkan menu_photo
                if ($loc->product->menu_photo) {
                    $imageUrl = $loc->product->menu_photo;
                    if (!str_starts_with($imageUrl, '/') && !str_starts_with($imageUrl, 'http')) {
                        $imageUrl = '/' . $imageUrl;
                    }
                }

                // Menambahkan booth_photo
                if ($loc->product->booth_photo) {
                    $boothPhotoUrl = $loc->product->booth_photo;
                    if (!str_starts_with($boothPhotoUrl, '/') && !str_starts_with($boothPhotoUrl, 'http')) {
                        $boothPhotoUrl = '/' . $boothPhotoUrl;
                    }
                }

                if ($loc->product->desctiption) {
                    $description = $loc->product->desctiption;
                }
            }

            return [
                'id' => $loc->id,
                'code' => $loc->code,
                'detail' => $loc->detail,
                'latitude' => $loc->latitude,
                'longitude' => $loc->longitude,
                'is_used' => $loc->isUsed(),
                'store_name' => $loc->product ? $loc->product->store_name : null,
                'image' => $imageUrl,
                'booth_photo' => $boothPhotoUrl,
                'description' => $description
            ];
        });
        return response()->json($locations);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::create($validated);

        return response()->json([
            'success' => true,
            'data' => $location
        ]);
    }

    public function index()
    {
        $locations = Location::all();
        return response()->json($locations);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json(['success' => true]);
    }
}
