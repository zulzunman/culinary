<?php

namespace App\Http\Controllers;

use App\Models\MerchantProfile;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function getAll()
    {
        $data = DB::table('products')
                    ->join('merchant_profiles', 'products.merchant_id', '=', 'merchant_profiles.id')
                    ->select('products.*', 'merchant_profiles.name as merchant_name', 'merchant_profiles.phone as merchant_phone')
                    ->get();

        // Mengirim data ke view
        return view('admin.store_master', compact('data'));
    }

    public function getDetail($id)
    {
        $product = Product::with('location')->findOrFail($id);
        $merchant = MerchantProfile::with(['religion', 'city'])
            ->where('id', $product->merchant_id)
            ->first();

        // Mengirim data ke view
        return view('admin.detail_store', compact('product', 'merchant'));
    }
}
