<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantProfile extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'merchant_profiles';
    protected $fillable = ['nik', 'name', 'gender', 'phone', 'religion_id', 'city_id', 'date', 'address', 'ktp_picture', 'user_id'];

    // Relasi one-to-one dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    // Relasi one-to-one dengan User
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    // Relasi one-to-one dengan User
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
