<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MerchantProfile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showRegister()
    {
        // Mengambil semua data dari tabel religion
        $locations = Location::all();
        $merchants = MerchantProfile::all();

        // Mengirim data ke view
        return view('store.create', compact('locations', 'merchants'));
    }

    function addData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'store_name' => 'required|string|max:255',
            'booth_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'menu_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'location_id' => 'required|exists:locations,id',
            'merchant_id' => 'required|exists:merchants,id',
        ]);

        // Upload file ke public/assets/img/ktp_picture dengan format nik-name-user_id
        $storeName = $request->store_name;
        $boothPhoto = $request->file('booth_photo');
        $menuPhoto = $request->file('menu_photo');
        $productPhoto = $request->file('product_photo');
        $merchantID = $request->merchant_id;

        // Menyimpan file dengan format nik-name-user_id
        $boothPhotoName = $storeName . '-' . str_replace(' ', '_', $merchantID) . '.' . $boothPhoto->getClientOriginalExtension();
        $boothPhotoPath = 'assets/img/ktp_picture/' . $boothPhotoName;
        $boothPhoto->move(public_path('assets/img/ktp_picture'), $boothPhotoName);

        $product = new Product;
        $product->name = $request->input('name');
        $product->store_name = $request->input('store_name');
        $product->booth_photo = $request->input('booth_photo');
        $product->menu_photo = $request->input('menu_photo');
        $product->product_photo = $request->input('product_photo');
        $product->location_id = $request->input('location_id');
        $product->merchant_id = $request->input('merchant_id');

    }
}
