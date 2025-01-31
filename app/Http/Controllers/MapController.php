<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getLocations()
    {
        // $locations = Location::all(); // Ambil semua data lokasi
        $locations = Location::all()->map(function ($loc) {
            return [
                'id' => $loc->id,
                'code' => $loc->code,
                'detail' => $loc->detail,
                'latitude' => $loc->latitude,
                'longitude' => $loc->longitude,
                'is_used' => $loc->isUsed(), // Tambahkan status apakah sudah dipakai
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
