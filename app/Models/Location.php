<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $fillable = ['code', 'detail', 'latitude', 'longitude'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    // Cek apakah lokasi sudah digunakan di tabel transactions
    public function isUsed()
    {
        return $this->hasOne(Product::class, 'location_id')->exists();
    }
}
