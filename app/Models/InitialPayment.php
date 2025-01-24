<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialPayment extends Model
{
    use HasFactory;
    // Tentukan nama tabel jika berbeda dengan nama default
    protected $table = 'initial_payments';
    protected $fillable = ['currency', 'date', 'photo', 'status', 'user_id '];

    // Relasi one-to-one dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
