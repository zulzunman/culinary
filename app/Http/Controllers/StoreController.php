<?php

namespace App\Http\Controllers;

use App\Models\MerchantProfile;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function getAll()
    {
        $data = DB::table('products')
                ->join('merchant_profiles', 'products.merchant_id', '=', 'merchant_profiles.id')
                ->select('products.*', 'merchant_profiles.name as merchant_name', 'merchant_profiles.phone as merchant_phone')
                ->whereNotNull('products.booth_photo') // Menyaring data agar booth_photo tidak null
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

    public function printCard()
    {
        $user = Auth::user();
        // Ambil data produk
        $merchant = MerchantProfile::where('user_id', $user->id)->first();
        $product = Product::where('merchant_id', $merchant->id)->first();

        // Load view untuk PDF
        $pdf = Pdf::loadView('store.print', [
            'product' => $product,
            'merchant' => $merchant,
            'judul' => 'Kartu Lapak'
        ]);

        // Pilihan generate PDF
        // Download langsung
        // return $pdf->download('kartu_lapak.pdf');

        // Atau tampilkan di browser
        return $pdf->stream('kartu_lapak.pdf');
    }
}
