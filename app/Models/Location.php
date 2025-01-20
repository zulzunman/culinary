<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'locations';
    protected $fillable = ['code', 'detail'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
