<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'citys';
    protected $fillable = ['name'];

    public function merchant()
    {
        return $this->hasOne(MerchantProfile::class);
    }
}
