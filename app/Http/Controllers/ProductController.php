<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MerchantProfile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $locations = Location::all(); // Add this line
        $merchantId = MerchantProfile::where('user_id', Auth::id())->value('id');
        $data = Product::where('merchant_id', $merchantId)->first();
        $user = Auth::user();
        $merchant = $user->merchant;
        // Pastikan merchant ada sebelum mengakses relasi
        if ($merchant) {
            $hasKtp = !is_null($merchant->ktp_picture);
            $hasBoothPhoto = !is_null(optional($merchant->product)->booth_photo);

            $condition = $hasKtp && $hasBoothPhoto;
        } else {
            $condition = false;
        }

        // Mengirim data ke view
        return view('store.index', compact('data', 'condition', 'locations'));
    }

    public function update()
    {
        // Fetch all locations
        $locations = Location::all();

        // Fetch the merchant ID
        $merchantId = MerchantProfile::where('user_id', Auth::id())->value('id');

        // Fetch the product
        $product = Product::where('merchant_id', $merchantId)->first();

        // Send data to view, including locations
        return view('store.edit', compact('locations', 'product'));
    }

    public function edit(Request $request)
    {
        try {
            // Find user by ID
            $merchantId = MerchantProfile::where('user_id', Auth::id())->value('id');
            $product = Product::where('merchant_id', $merchantId)->first();

            if (!$product) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found',
                ], 404);
            }

            $request->validate([
                'name' => 'sometimes|string|max:255',
                'store_name' => 'sometimes|string|max:255',
                'category' => 'sometimes|string|max:255',
                'desctiption' => 'sometimes|string',
                'booth_photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                'menu_photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                'product_photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                'location_id' => 'sometimes|exists:locations,id',
            ]);

            // Start database transaction
            return DB::transaction(function () use ($request, $product, $merchantId) {
                // Update basic fields
                if ($request->has('name')) {
                    $product->name = $request->name;
                }
                if ($request->has('store_name')) {
                    $product->store_name = $request->store_name;
                }
                if ($request->has('category')) {
                    $product->category = $request->category;
                }
                if ($request->has('desctiption')) {
                    $product->desctiption = $request->desctiption;
                }

                // Handle booth photo upload
                if ($request->hasFile('booth_photo')) {
                    try {
                        $boothPhoto = $request->file('booth_photo');
                        $store_name = $request->store_name;

                        // Delete old photo if exists
                        if ($product->booth_photo && file_exists(public_path($product->booth_photo))) {
                            unlink(public_path($product->booth_photo));
                        }

                        $filename = $merchantId . '-' . str_replace(' ', '_', $store_name) . '.' . $boothPhoto->getClientOriginalExtension();
                        $destinationPath = 'assets/img/booth_photo/' . $filename;
                        $boothPhoto->move(public_path('assets/img/booth_photo'), $filename);
                        $product->booth_photo = $destinationPath;
                    } catch (\Exception $e) {
                        throw new \Exception('Failed to upload booth photo: ' . $e->getMessage());
                    }
                }

                // Handle menu photo upload
                if ($request->hasFile('menu_photo')) {
                    try {
                        $menuPhoto = $request->file('menu_photo');
                        $store_name = $request->store_name;

                        if ($product->menu_photo && file_exists(public_path($product->menu_photo))) {
                            unlink(public_path($product->menu_photo));
                        }

                        $filename = $merchantId . '-' . str_replace(' ', '_', $store_name) . '.' . $menuPhoto->getClientOriginalExtension();
                        $destinationPath = 'assets/img/menu_photo/' . $filename;
                        $menuPhoto->move(public_path('assets/img/menu_photo'), $filename);
                        $product->menu_photo = $destinationPath;
                    } catch (\Exception $e) {
                        throw new \Exception('Failed to upload menu photo: ' . $e->getMessage());
                    }
                }

                // Handle product photo upload
                if ($request->hasFile('product_photo')) {
                    try {
                        $productPhoto = $request->file('product_photo');
                        $store_name = $request->store_name;

                        if ($product->product_photo && file_exists(public_path($product->product_photo))) {
                            unlink(public_path($product->product_photo));
                        }

                        $filename = $merchantId . '-' . str_replace(' ', '_', $store_name) . '.' . $productPhoto->getClientOriginalExtension();
                        $destinationPath = 'assets/img/product_photo/' . $filename;
                        $productPhoto->move(public_path('assets/img/product_photo'), $filename);
                        $product->product_photo = $destinationPath;
                    } catch (\Exception $e) {
                        throw new \Exception('Failed to upload product photo: ' . $e->getMessage());
                    }
                }

                $product->save();

                return redirect()->route('store.index')->with('success', 'Berhasil melengkapi data');
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
