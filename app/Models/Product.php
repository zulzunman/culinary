<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'products';
    protected $fillable = ['name', 'store_name', 'booth_photo', 'menu_photo', 'product_photo', 'location_id', 'merchant_id'];

    // Relasi one-to-one dengan Merchant
    public function merchant()
    {
        return $this->belongsTo(MerchantProfile::class);
    }

    // Relasi one-to-one dengan Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
