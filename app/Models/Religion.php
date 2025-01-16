<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'religions';
    protected $fillable = ['name'];

    public function merchant()
    {
        return $this->hasOne(MerchantProfile::class);
    }
}
