<?php

namespace App\Http\Controllers;

use App\Models\MerchantProfile;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $data = MerchantProfile::all();

        // Mengirim data ke view
        return view('merchant.index', compact('data'));
    }
}
